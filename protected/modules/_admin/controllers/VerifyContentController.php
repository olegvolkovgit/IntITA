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


                $langs = array('ua', 'ru', 'en');
                foreach($langs as $lang) {
                    Yii::app()->session['lg'] = $lang;
                    //$messages = Messages::model()->getMessagesForSchemabyLang($lg[$i]);
                    $html = $this->actionGeneratePage($page);
                    $file = StaticFilesHelper::pathToLecturePageHtml($model->idModule, $model->id, $page->page_order, $lang);
                    file_put_contents($file, $html);
                }
            }
            die;
        }
        else {
                throw new CException('Лекція не затверджена адміністратором і не може бути збережена! Lecture::generateLectureHtml()');
            }
    }

    public function actionGeneratePage(LecturePage $page)
    {
        $textList = LecturePage::getBlocksListById($page->id);
        $dataProvider = LectureElement::getLectureText($textList);

        return $this->renderPartial('/lesson/_jsLecturePageTabs', array(
            'lectureId'=>$page->id_lecture,
            'page' => $page,
            'lastAccessPage' => $lastAccessPage,
            'dataProvider' => $dataProvider,
            'finishedLecture' => $finishedLecture,
            'passedLecture' => $passedLecture,
            'passedPages' => $passedPages,
            'editMode' => 0,
            'user' => $user,
            'order' => $page->page_order,
            'idCourse' => 0
        ));
    }

}