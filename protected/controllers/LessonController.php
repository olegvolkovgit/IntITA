<?php
/* @var $lecture Lecture*/

class LessonController extends Controller{

    public function initialize($id)
    {
        $lecture = Lecture::model()->findByPk($id);
        if (!($lecture->isFree)){
            if(Yii::app()->user->isGuest){
            throw new CHttpException(403, Yii::t('errors', '0138'));
            }
            else{
                if(AccessHelper::getRole(Yii::app()->user->getId())=='викладач'){
                    if(TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule))
                        return true;
                }
                $modulePermission = new PayModules();
                if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read'))) {
                throw new CHttpException(403, Yii::t('errors', '0139'));
                }
            }
        }
    }

    public function actionIndex($id,$idCourse)
    {
        $lecture = Lecture::model()->findByPk($id);
        $this->initialize($id);
        $editMode = $this->checkEditMode($lecture->idModule, Yii::app()->user->getId());
        if (Yii::app()->user->isGuest) {
            $user = 0;
        } else{
            $user = Yii::app()->user->getId();

        }


        $criteria = new CDbCriteria();
        $criteria->addCondition('id_lecture=' . $id);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );

        $temp = TeacherModule::model()->find('idModule=' . $lecture->idModule);
        $teacher = Teacher::model()->findByPk($temp->idTeacher);

        $countBlocks = LectureElement::model()->count('id_lecture = :id', array(':id' => $id));

//        if (Yii::app()->request->isAjaxRequest){
//            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
//            Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
//            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;
//            $this->renderPartial('_blocks_list', array(
//                'dataProvider'=>$dataProvider,
//                'editMode' => $editMode,
//            ), false, true);
//            Yii::app()->end();
//        } else {
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,
            'editMode' => $editMode,
            'countBlocks' => $countBlocks,
            'teacher' => $teacher,
            'idCourse' => $idCourse,
            'user' =>$user,
        ));
        //}
    }

    public function actionUpdateAjax()
    {
        $data = array();
        $data["day"] = $_POST['dateconsajax'];
        $data["teacherId"] = $_POST['teacherIdajax'];
        $this->renderPartial('_timeConsult', $data, false, true);
    }

    public function actionUnableLesson(){
        $this->render('unableLesson');
    }

    public function actionSave(){
        $order = substr(Yii::app()->request->getPost('order'), 2);
        $id = Yii::app()->request->getPost('idLecture');
        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $id,'block_order' => $order));
        $model->html_block = Yii::app()->request->getPost('content');

        $model->save();
    }

    public function actionSaveFormula(){


        $htmlBlock = Yii::app()->request->getPost('content');
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

       // $content = substr($htmlBlock, 2, count($htmlBlock) - 5);

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture,'block_order' => $order));
        $model->html_block = $htmlBlock;
        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateNewBlock(){
        $model = new LectureElement();

        $idType = Yii::app()->request->getPost('type');
        $htmlBlock = Yii::app()->request->getPost('newTextBlock');
        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::model()->count('id_lecture = :id', array(':id' => Yii::app()->request->getPost('idLecture')))+1;

        switch ($idType){
//            case '1':
//                $model->html_block = $this->redirectTextLinks($htmlBlock);
//                break;
            case '2':
                 //if we want to load video, we finding video link
                $tempArray = explode(" ", $htmlBlock);
                for ($i = count($tempArray)-1; $i > 0; $i--) {
                    if ($this->startsWith($tempArray[$i], 'src="')) {
                        $link = substr($tempArray[$i], 5, strlen($tempArray[$i]) - 1);
                        $model->html_block = $link;
                    }
                }
                break;
//            case '4':
//                $model->html_block = $this->redirectTextLinks($htmlBlock);
//                break;
//            case '5':
//                $model->html_block = $this->redirectTextLinks($htmlBlock);
//                break;
//            case '6':
//                $model->html_block = $this->redirectTextLinks($htmlBlock);
//                break;
//            case '7':
//                $model->html_block = $this->redirectTextLinks($htmlBlock);
//                break;
            case '9':
                $tempArray = explode(" ", $htmlBlock);
                for ($i = count($tempArray)-1; $i > 0; $i--) {
                    if ($this->startsWith($tempArray[$i], 'src="')) {
                        $link = substr($tempArray[$i], 5, strlen($tempArray[$i]) - 6);
                        $model->html_block = $link;
                    }
                }
                break;
            case '10':
                $model->html_block = substr($htmlBlock, 0, count($htmlBlock) - 2);
                break;
            default:
                $model->html_block = $htmlBlock;
        }
        $model->id_type = $idType;
        $model->type = ElementType::model()->findByPk($idType)->type;

        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    private function startsWith($haystack, $needle) {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }

    public function redirectTextLinks($htmlBlock){
        var_dump($htmlBlock);die();
        $tempArray = explode(" ", $htmlBlock);
        $result = [];
        for ($i = count($tempArray)-1; $i > 0; $i--) {
            $result .= $tempArray[$i];
            if ($this->startsWith($tempArray[$i], 'href="')) {
                $result .= ' target="_blank" ';
            }
        }
        var_dump($result);die();
        return $result;
    }


    //reorder blocks on lesson page - up block
    public function actionUpElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists prev element, reorder current and prev elements
        if($order > 1) {
            $this->swapBlocks($idLecture, $order - 1, $order);
        }

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - down block
    public function actionDownElement(){
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists next element, reorder current and next elements
        if($order < LectureElement::model()->count('id_lecture='.$idLecture)) {
            $this->swapBlocks($idLecture, $order, $order + 1);
        }
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //delete block on lesson page
    public function actionDeleteElement(){
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));

        switch ($model->id_type){
            case '5': Task::deleteTask($model->id_block);
        }
        //delete current block
        LectureElement::model()->deleteAllByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));

        //reorder elements after deleted block
        $this->reorderBlocks($idLecture, $order);
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public  function reorderBlocks($idLecture, $order){
        //count number of blocks in lecture and increment(because we delete one record in actionDeleteElement)
        $countBlocks = LectureElement::model()->count('id_lecture = :id', array(':id' => $idLecture));
        $countBlocks++;
        //change orders in blocks of lesson after deleted record(block)
        for ($i = $order+1; $i <= $countBlocks; $i++){
            $id = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $i))->id_block;
            LectureElement::model()->updateByPk($id, array('block_order' => $i-1));
        }
    }

    public function swapBlocks($idLecture, $first, $second)
    {
        //find blocks id's for first and second elements
        $firstId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $first))->id_block;
        $secondId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $second))->id_block;
        //swap blocks - rewrite block order in DB
        LectureElement::model()->updateByPk($secondId, array('block_order' => $first));
        LectureElement::model()->updateByPk($firstId, array('block_order' => $second));
    }

    public function checkEditMode($idModule, $idUser){
        $permission = new PayModules();
        if ($permission->checkModulePermission($idUser, $idModule, array('edit'))) {
            return true;
        } else {
            return false;
        }
    }

    public function actionUploadImage(){
        $path = StaticFilesHelper::createLectureImagePath();
        // files storage folder
        $dir = Yii::getpathOfAlias('webroot').$path;

        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);

        if ($_FILES['file']['type'] == 'image/png'
            || $_FILES['file']['type'] == 'image/jpg'
            || $_FILES['file']['type'] == 'image/gif'
            || $_FILES['file']['type'] == 'image/jpeg'
            || $_FILES['file']['type'] == 'image/pjpeg')
        {
            // setting file's mysterious name
            $filename = md5(date('YmdHis')).'.jpg';
            $file = $dir.$filename;

            // copying
            copy($_FILES['file']['tmp_name'], $file);


            // displaying file
            $array = array(
                'filelink' => '/images/lecture/'.$filename
            );

            echo stripslashes(json_encode($array));

        }
    }

    public function actionFormulaRedactor(){
        $this->render('formulaRedactor');
    }

    public function actionErrorTask(){
        $this->redirect(Yii::app()->request->urlReferrer);
    }

}