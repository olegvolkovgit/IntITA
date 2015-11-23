<?php

class VerifyContentController extends AdminController {

    public function actionIndex(){
        $this->render('index');
    }

    public function actionInitializeDir(){
        if(!file_exists(Yii::app()->basePath . "/../content")){
            mkdir(Yii::app()->basePath . "/../content");
        }
        $this->initializeModules();
        $this->initializeLectures();

        $this->actionIndex();
    }

    public function initializeModules(){
        $modules = Module::model()->findAll();
        foreach($modules as $record){
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$record->module_ID)){
                mkdir(Yii::app()->basePath . "/../content/module_".$record->module_ID);
            }
        }
    }

    public function initializeLectures(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule>0');
        $lectures = Lecture::model()->findAll($criteria);

        foreach($lectures as $record){
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$record->idModule."/lecture_".$record->id)){
                mkdir(Yii::app()->basePath . "/../content/module_".$record->idModule."/lecture_".$record->id);
            }
        }
    }

    public function actionConfirm($id){
        $model = Lecture::model()->findByPk($id);

        if ($model){
            $model->verified = 1;
            $model->save();
            $this->generateLecturePages($model);
        } else {
            throw new CException("Такої лекції немає!");
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function generateLecturePages(Lecture $model){
        if ($model->isVerified()) {
            $pages = LecturePage::getAllLecturePages($model->id);
            foreach ($pages as $page) {
                $textList = LecturePage::getBlocksListById($page->id);
                $dataProvider = LectureElement::getLectureText($textList);

                $schema = $this->renderPartial('_lecturePageTemplate', array(
                    'page' => $page,
                    'dataProvider' => $dataProvider,
                    'user' => Yii::app()->user->getId(),
                ), true);

                $file = StaticFilesHelper::pathToLecturePageHtml($model->idModule, $model->id, $page->page_order);
                file_put_contents($file, $schema);
            }
            die;
        }
        else {
                throw new CException('Лекція не затверджена адміністратором і не може бути збережена! Lecture::generateLectureHtml()');
            }
    }

    public function actionPageAjaxUpdate()
    {
        $user=Yii::app()->user->getId();
        $id = $_GET['lectureId'];
        $lecture = Lecture::model()->findByPk($id);
        $editMode = PayModules::checkEditMode($lecture->idModule, Yii::app()->user->getId());

        $this->initialize($id,$editMode);

        $passedPages = LecturePage::getAccessPages($id, $user);
        $lastAccessPage = LectureHelper::lastAccessPage($passedPages) + 1;

        if (is_string($_GET['page'])) $thisPage = $_GET['page'];
        else if($editMode) $thisPage = 1;
        else $thisPage = $lastAccessPage;

        $passedLecture = LectureHelper::isPassedLecture($passedPages);
        $finishedLecture = LectureHelper::isLectureFinished($user, $id);

        $page_order=$_GET['page'];
        $page = LecturePage::model()->findByAttributes(array('id_lecture' => $id, 'page_order' => $page_order));

        $textList = LecturePage::getBlocksListById($page->id);

        $dataProvider = LectureElement::getLectureText($textList);

        if (!($passedPages[$thisPage-1]['isDone'] || $editMode || AccessHelper::isAdmin())){
            echo Yii::t('lecture', '0640');
        }
        else{
            echo $this->renderPartial('/lesson/_page',array('id'=>$id,'page'=>$page,'dataProvider'=>$dataProvider,
                'user'=>$user,'finishedLecture'=>$finishedLecture,'passedLecture'=>$passedLecture,
                'passedPages'=>$passedPages, 'thisPage'=>$thisPage, 'edit'=>0,  'editMode' => $editMode),false,true);
        }
    }

}