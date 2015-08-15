<?php
/* @var $lecture Lecture*/

class LessonController extends Controller{

    public function initialize($id)
    {
        $lecture = Lecture::model()->findByPk($id);
        $enabledLessonOrder=LectureHelper::getLastEnabledLessonOrder($lecture->idModule);
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
                if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read')) || $lecture->order>$enabledLessonOrder) {
                throw new CHttpException(403, Yii::t('errors', '0139'));
                }
            }
        }
    }

    public function actionIndex($id,$idCourse, $page=1)
    {
        $lecture = Lecture::model()->findByPk($id);
        $this->initialize($id);
        $editMode = $this->checkEditMode($lecture->idModule, Yii::app()->user->getId());

        if (Yii::app()->user->isGuest) {
            $user = 0;
        } else{
            $user = Yii::app()->user->getId();
        }

        $page = LecturePage::model()->findByAttributes(array('id_lecture' => $id, 'page_order' => $page));

        $textList = LecturePage::getBlocksListById($page->id);

        $criteria = new CDbCriteria();
        $criteria->addInCondition('id_block', $textList);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );

        $temp = TeacherModule::model()->find('idModule=' . $lecture->idModule);
        $teacher = Teacher::model()->findByPk($temp->idTeacher);

        $passedPages = LecturePage::getAccessPages($id, $user);
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
        $this->render('index1', array(
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,
            'editMode' => $editMode,
            'passedPages' => $passedPages,
            'countBlocks' => $countBlocks,
            'teacher' => $teacher,
            'idCourse' => $idCourse,
            'user' =>$user,
            'page' => $page,
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
        $model->html_block = str_replace("\n</p>","</p>",Yii::app()->request->getPost('content'));

        $model->save();
    }

    public function actionSaveFormula(){
        $htmlBlock = Yii::app()->request->getPost('content');
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

       // $content = substr($htmlBlock, 2, count($htmlBlock) - 5);

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture,'block_order' => $order));
        if(strpos($htmlBlock,'$\displaystyle ')===0) {
            $temp=substr_replace($htmlBlock,'\[',0,15);
            $model->html_block = substr_replace($temp,'\]',strrpos($temp,'$'),1);
        }elseif(strpos($htmlBlock,'$')===0) {
            $temp = substr_replace($htmlBlock, '\[', 0, 1);
            $model->html_block = substr_replace($temp, '\]', strrpos($temp, '$'), 1);
        }elseif(strpos($htmlBlock,'\[\inline')===0) {
            $model->html_block = substr_replace($htmlBlock, '\[', 0, 10);
        }else{
            $model->html_block = $htmlBlock;
        }
        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddVideo(){
        $model = new LectureElement();

        $htmlBlock = Yii::app()->request->getPost('newVideoUrl');
        $pageOrder = Yii::app()->request->getPost('page');

        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = 0;
        $model->html_block = $htmlBlock;
        $model->id_type = 2;
        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::getLastVideoId($model->id_lecture);

        LecturePage::addVideo($pageId, $id["id_block"]);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddFormula(){
        $model = new LectureElement();

        $htmlBlock = Yii::app()->request->getPost('newFormula');
        $pageOrder = Yii::app()->request->getPost('page');

        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::model()->count('id_lecture = :id', array(':id' => Yii::app()->request->getPost('idLecture')))+1;

        if(strpos($htmlBlock,'$\displaystyle ')===0) {
            $temp=substr_replace($htmlBlock,'\[',0,15);
            $model->html_block = substr_replace($temp,'\]',strrpos($temp,'$'),1);
        }
        elseif(strpos($htmlBlock,'$')===0) {
            $temp = substr_replace($htmlBlock, '\[', 0, 1);
            $model->html_block = substr_replace($temp, '\]', strrpos($temp, '$'), 1);
        }elseif(strpos($htmlBlock,'\[\inline')===0) {
            $model->html_block = substr_replace($htmlBlock, '\[', 0, 10);
        }else{
            $model->html_block = $htmlBlock;
        }

        $model->id_type = 10;
        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'block_order' => $model->block_order))->id_block;

        LecturePage::addTextBlock($id, $pageId);


        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateNewBlock(){
        $model = new LectureElement();

        $pageOrder = Yii::app()->request->getPost('page');
        $idType = Yii::app()->request->getPost('type');
        $htmlBlock = Yii::app()->request->getPost('newTextBlock');
        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::model()->count('id_lecture = :id', array(':id' => Yii::app()->request->getPost('idLecture'))) + 1;

        switch ($idType){
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
            case '4':
                $model->html_block = '<pre>'.$htmlBlock.'</pre>';
                 break;
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
                if(strpos($htmlBlock,'$\displaystyle ')===0) {
                    $temp=substr_replace($htmlBlock,'\[',0,15);
                    $model->html_block = substr_replace($temp,'\]',strrpos($temp,'$'),1);
                }
                elseif(strpos($htmlBlock,'$')===0) {
                    $temp = substr_replace($htmlBlock, '\[', 0, 1);
                    $model->html_block = substr_replace($temp, '\]', strrpos($temp, '$'), 1);
                }elseif(strpos($htmlBlock,'\[\inline')===0) {
                $model->html_block = substr_replace($htmlBlock, '\[', 0, 10);
                }else{
                    $model->html_block = $htmlBlock;
                }
                break;
            default:
                $model->html_block = $htmlBlock;
        }
        $model->id_type = $idType;

        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'block_order' => $model->block_order))->id_block;

        LecturePage::addTextBlock($id, $pageId);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    private function startsWith($haystack, $needle) {
        return substr($haystack, 0, strlen($needle)) === $needle;
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

    public function actionUpdateLectureAttribute(){
        $up = new EditableSaver('Lecture');
        $up->update();
    }

    public function actionUpdateLecturePageAttribute(){
        $up = new EditableSaver('LecturePage');
        $up->update();
    }

    public function actionUpdateLectureElementAttribute(){
        $up = new EditableSaver('LectureElement');
        $up->update();
    }

    public function actionShowPagesList(){
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $idCourse = Yii::app()->request->getPost('idCourse', 0);

        $idModule = Lecture::model()->findByPk($idLecture)->idModule;
        if($this->checkEditMode($idModule, Yii::app()->user->getId())) {
            return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
        }else{
            throw new CHttpException(403, 'У вас недостатньо прав для редагування цього заняття.');
        }
    }

    public function actionDeletePage(){
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $pageOrder = Yii::app()->request->getPost('pageOrder', 1);
        $idCourse = Yii::app()->request->getPost('idCourse', 1);

        LecturePage::deletePage($idLecture, $pageOrder);

        $this->reorderPages($idLecture, $pageOrder);

        return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
    }

    public function actionShowPageEditor(){
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $pageOrder = Yii::app()->request->getPost('pageOrder', 1);
        $idModule = Lecture::model()->findByPk($idLecture)->idModule;

        if($this->checkEditMode($idModule, Yii::app()->user->getId())) {
        $page = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $pageOrder));

        $textList = LecturePage::getBlocksListById($page->id);
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id_block', $textList);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );

        $countBlocks = LectureElement::model()->count('id_lecture = :id', array(':id' => $idLecture));

        return $this->renderPartial('_editLecturePageTabs', array(
            'page' => $page, 'dataProvider'=>$dataProvider, 'countBlocks' => $countBlocks, 'editMode' => 0, 'user' => Yii::app()->user->getId(), false, true));
        }else{
            throw new CHttpException(403, 'У вас недостатньо прав для редагування цього заняття.');
        }
    }

    public function actionAddNewPage($lecture, $page){

        $this->reorderLecturePagesDown($lecture, $page+1);
        LecturePage::addNewPage($lecture, $page+1);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block
    public function reorderLecturePagesDown($lecture, $page)
    {
        if($page > 1) {
            $this->swapLecturePages($lecture, $page);
        }
    }

    public function swapLecturePages($lecture, $page)
    {
        $pagesCount = LecturePage::model()->count('id_lecture=:id', array(':id' => $lecture));
        for($i = $page; $i <= $pagesCount; $i++){
            $model = LecturePage::model()->findByAttributes(array('id_lecture'=>$lecture,'page_order'=>$i));
            $model->attributes=array('page_order' => $i+1);
            $model->save();
        }
    }

    //reorder blocks on lesson page - up block
    public function actionUpPage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');
        $idCourse = Yii::app()->request->getPost('idCourse', 1);

        if($pageOrder > 1) {
            $this->swapPages($idLecture, $pageOrder - 1, $pageOrder);
        }

        return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
    }

    //reorder blocks on lesson page - down block
    public function actionDownPage(){

        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');
        $idCourse = Yii::app()->request->getPost('idCourse', 1);

        if($pageOrder < LecturePage::model()->count('id_lecture='.$idLecture)) {
            $this->swapPages($idLecture, $pageOrder, $pageOrder + 1);
        }

        return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
    }

    public function swapPages($idLecture, $first, $second)
    {
        //find blocks id's for first and second pages
        $firstId = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $first))->id;
        $secondId = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $second))->id;
        //swap blocks - rewrite page order in DB
        LecturePage::model()->updateByPk($secondId, array('page_order' => $first));
        LecturePage::model()->updateByPk($firstId, array('page_order' => $second));
    }

    public  function reorderPages($idLecture, $pageOrder){

        $countPages = LecturePage::model()->count('id_lecture = :id', array(':id' => $idLecture));
        $countPages++;

        for ($i = $pageOrder+1; $i <= $countPages; $i++){
            $id = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $i))->id;
            LecturePage::model()->updateByPk($id, array('page_order' => $i-1));
        }
    }
}