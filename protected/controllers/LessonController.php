<?php

/* @var $lecture Lecture */
class LessonController extends Controller
{
    public $layout = 'lessonlayout';
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    public function accessRules()
    {
        return array(
            array('deny',
                'users'=>array('?'),
            ),
        );
    }
    public function initialize($id,$editMode)
    {
        $lecture = Lecture::model()->findByPk($id);
        $enabledLessonOrder = LectureHelper::getLastEnabledLessonOrder($lecture->idModule);
        if (Yii::app()->user->isGuest) {
            throw new CHttpException(403, Yii::t('errors', '0138'));
        }
        if (AccessHelper::isAdmin() || $editMode) {
            return true;
        }
        if (!($lecture->isFree)) {
            $modulePermission = new PayModules();
            if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read')) || $lecture->order > $enabledLessonOrder) {
                throw new CHttpException(403, Yii::t('errors', '0139'));
            }
        }else {
            if ($lecture->order > $enabledLessonOrder)
                throw new CHttpException(403, Yii::t('errors', '0646'));
        }
    }

    public function actionIndex($id, $idCourse=0, $page = 1)
    {
        $lecture = Lecture::model()->findByPk($id);
        $editMode = PayModules::checkEditMode($lecture->idModule, Yii::app()->user->getId());

        $this->initialize($id,$editMode);

        if (Yii::app()->user->isGuest) {
            $user = 0;
        } else {
            $user = Yii::app()->user->getId();
        }

        $passedPages = LecturePage::getAccessPages($id, $user);
        $lastAccessPage = LectureHelper::lastAccessPage($passedPages) + 1;

        if ($editMode) $page = 1;
        else $page = $lastAccessPage;

        if (isset($_GET['editPage'])) {
            $page = $_GET['editPage'];
        }
        if (is_string($_GET['page'])) {
            $page = $_GET['page'];
        }

        $page = LecturePage::model()->findByAttributes(array('id_lecture' => $id, 'page_order' => $page));

        $textList = LecturePage::getBlocksListById($page->id);

        $dataProvider = LectureElement::getLectureText($textList);

        $teacherId = Teacher::getLectureTeacher($id);

        if ($teacherId != 0) {
            $teacher = Teacher::model()->findByPk($teacherId);
        } else {
            $teacher = null;
        }

        $this->render('index1', array(
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,
            'editMode' => $editMode,
            'passedPages' => $passedPages,
            'teacher' => $teacher,
            'idCourse' => $idCourse,
            'user' => $user,
            'page' => $page,
            'lastAccessPage' => $lastAccessPage,
        ));
    }

    public function actionUpdateAjax()
    {
        $data = array();
        $data["day"] = $_POST['dateconsajax'];
        $data["teacherId"] = $_POST['teacherIdajax'];
        $this->renderPartial('_timeConsult', $data, false, true);
    }

    public function actionSave()
    {
        $order = substr(Yii::app()->request->getPost('order'), 2);
        $id = Yii::app()->request->getPost('idLecture');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $id, 'block_order' => $order));
        $model->html_block = str_replace("\n</p>", "</p>", Yii::app()->request->getPost('content'));

        $model->save();
    }

    public function actionSaveFormula()
    {
        $htmlBlock = Yii::app()->request->getPost('content');
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));
        $model->html_block = $htmlBlock;
        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddVideo()
    {
        $htmlBlock = Yii::app()->request->getPost('newVideoUrl');
        $pageOrder = Yii::app()->request->getPost('page');
        $lectureId = Yii::app()->request->getPost('idLecture');
        LectureElement::addVideo($htmlBlock,$pageOrder,$lectureId);
//        $model = new LectureElement();
//
//        $htmlBlock = Yii::app()->request->getPost('newVideoUrl');
//        $pageOrder = Yii::app()->request->getPost('page');
//
//        $model->id_lecture = Yii::app()->request->getPost('idLecture');
//        $model->block_order = 0;
//        $model->html_block = $htmlBlock;
//        $model->id_type = 2;
//        $model->save();
//
//        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
//        $id = LectureElement::getLastVideoId($model->id_lecture);
//
//        LecturePage::addVideo($pageId, $id["id_block"]);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddFormula()
    {
        $model = new LectureElement();

        $htmlBlock = Yii::app()->request->getPost('newFormula');
        $pageOrder = Yii::app()->request->getPost('page');

        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::getNextOrder(Yii::app()->request->getPost('idLecture'));
        $model->html_block = $htmlBlock;

        $model->id_type = 10;
        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'block_order' => $model->block_order))->id_block;

        LecturePage::addTextBlock($id, $pageId);


        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateNewBlock()
    {
        $model = new LectureElement();

        $pageOrder = Yii::app()->request->getPost('page');
        $idType = Yii::app()->request->getPost('type');
//        $htmlBlock = Yii::app()->request->getPost('newTextBlock');
        $htmlBlock = Yii::app()->request->getPost('editorAdd');
        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = LectureElement::getNextOrder(Yii::app()->request->getPost('idLecture'));

        $model->html_block = $htmlBlock;
        $model->id_type = $idType;

        $model->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::model()->findByAttributes(array('id_lecture' => $model->id_lecture, 'block_order' => $model->block_order))->id_block;

        LecturePage::addTextBlock($id, $pageId);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block
    public function actionUpElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists prev element, reorder current and prev elements
        $textList = Lecture::getTextList($idLecture, $order);
        $prevElement = LectureElement::getPrevElement($textList, $order);
        LectureElement::swapBlock($idLecture, $prevElement, $order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - down block
    public function actionDownElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists next element, reorder current and next elements
        $textList = Lecture::getTextList($idLecture, $order);
        $nextElement = LectureElement::getNextElement($textList, $order);
        LectureElement::swapBlock($idLecture, $nextElement, $order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //delete block on lesson page
    public function actionDeleteElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));

        switch ($model->id_type) {
            case '5':
                Task::deleteTask($model->id_block);
        }
        //delete current block
        LectureElement::deleteCurrentBlock($idLecture, $order, $model->id_block);

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }
    //delete block on lesson page
    public function actionDeleteVideo()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');

        $modelLecturePage = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $pageOrder));
        if($modelLecturePage->video){
            $elementId=$modelLecturePage->video;
            LecturePage::model()->updateByPk($modelLecturePage->id, array('video' => NULL));
            LectureElement::model()->deleteByPk($elementId);
        }

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUploadImage()
    {
        $path = StaticFilesHelper::createLectureImagePath();
        // files storage folder
        $dir = Yii::getpathOfAlias('webroot') . $path;

        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);

        if ($_FILES['file']['type'] == 'image/png'
            || $_FILES['file']['type'] == 'image/jpg'
            || $_FILES['file']['type'] == 'image/gif'
            || $_FILES['file']['type'] == 'image/jpeg'
            || $_FILES['file']['type'] == 'image/pjpeg'
        ) {
            // setting file's mysterious name
            $filename = md5(date('YmdHis')) . '.jpg';
            $file = $dir . $filename;

            // copying
            copy($_FILES['file']['tmp_name'], $file);

            // displaying file
            $array = array(
                'filelink' => '/images/lecture/' . $filename
            );

            echo stripslashes(json_encode($array));
        }
    }

    public function actionCKEUploadImage()
    {
        $path = StaticFilesHelper::createLectureImagePath();
        // files storage folder
        $dir = Yii::getpathOfAlias('webroot') . $path;

        $_FILES['upload']['type'] = strtolower($_FILES['upload']['type']);
        if ($_FILES['upload']['type'] == 'image/png'
            || $_FILES['upload']['type'] == 'image/jpg'
            || $_FILES['upload']['type'] == 'image/gif'
            || $_FILES['upload']['type'] == 'image/jpeg'
            || $_FILES['upload']['type'] == 'image/pjpeg'
        ) {
            $callback = $_GET['CKEditorFuncNum'];
            $filename = md5(date('YmdHis')) . $_FILES['upload']['name'];
            $full_path = $dir . $filename;
            $http_path = Config::getBaseUrl().'/images/lecture/' . $filename;
            $error = '';
            if (move_uploaded_file($_FILES['upload']['tmp_name'], $full_path)) {
            } else {
                $error = 'Что-то пошло не так!';
                $http_path = '';
            }
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(" . $callback .
                ",\"" . $http_path . "\", \"" . $error . "\" );</script>";
        }else{
            $callback = $_GET['CKEditorFuncNum'];
            $error = Yii::t('error', '0672');
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(" . $callback .
                ",\"" . '' . "\", \"" . $error . "\" );</script>";
        }
    }

    public function actionFormulaRedactor()
    {
        $this->render('formulaRedactor');
    }

    public function actionNextPage($id, $idCourse=0, $page)
    {
        $nextPage = LecturePage::getNextPage($id, $page);

        $this->redirect(Yii::app()->createUrl("lesson/index", array('id' => $id, 'idCourse' => $idCourse, 'page' => $nextPage)));
    }

    public function actionNextLecture($lectureId, $idCourse=0)
    {
        $lecture=Lecture::model()->findByPk($lectureId);
        if ( $lecture->order < $lecture->getModuleInfoById($idCourse)['countLessons']){
            $nextId = LectureHelper::getNextId($lecture['id']);
            $this->redirect(Yii::app()->createUrl('lesson/index', array('id' => $nextId, 'idCourse'=>$idCourse)));
        }
        else{
            $this->redirect($_SERVER["HTTP_REFERER"]);
        }
    }
    public function actionUpdateLectureAttribute()
    {
        $up = new EditableSaver('Lecture');
        $up->update();
    }

    public function actionUpdateLecturePageAttribute()
    {
        $up = new EditableSaver('LecturePage');
        $up->update();
    }

    public function actionUpdateLectureElementAttribute()
    {
        $up = new EditableSaver('LectureElement');
        $up->update();
    }

    public function actionShowPagesList($id, $idCourse)
    {

        $idModule = Lecture::model()->findByPk($id)->idModule;
        if (PayModules::checkEditMode($idModule, Yii::app()->user->getId())) {
            return $this->render('/editor/_pagesList', array('idLecture' => $id, 'idCourse' => $idCourse));
        } else {
            throw new CHttpException(403, 'У вас недостатньо прав для редагування цього заняття.');
        }
    }

    public function actionDeletePage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $pageOrder = Yii::app()->request->getPost('pageOrder', 1);

        LecturePage::deletePage($idLecture, $pageOrder);
        LecturePage::reorderPages($idLecture, $pageOrder);
    }

    public function actionShowPageEditor()
    {
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $pageOrder = Yii::app()->request->getPost('pageOrder', 1);
        $idModule = Lecture::model()->findByPk($idLecture)->idModule;

        if (PayModules::checkEditMode($idModule, Yii::app()->user->getId())) {
            $page = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $pageOrder));
            $dataProvider = LecturePage::getPageTextList($idLecture, $pageOrder);

            return $this->renderPartial('_editLecturePageTabs', array(
                'page' => $page, 'dataProvider' => $dataProvider, 'editMode' => 0, 'user' => Yii::app()->user->getId(), false, true));
        }
        throw new CHttpException(403, 'У вас недостатньо прав для редагування цього заняття.');
    }

    public function actionAddNewPage($lecture, $page)
    {
        LecturePage::reorderLecturePagesDown($lecture, $page + 1);
        LecturePage::addNewPage($lecture, $page + 1);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block
    public function actionUpPage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');
        $idCourse = Yii::app()->request->getPost('idCourse', 1);

        if ($pageOrder > 1) {
            LecturePage::swapPages($idLecture, $pageOrder - 1, $pageOrder);
        }

        return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
    }

    //reorder blocks on lesson page - down block
    public function actionDownPage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');
        $idCourse = Yii::app()->request->getPost('idCourse', 1);

        if ($pageOrder < LecturePage::model()->count('id_lecture=' . $idLecture)) {
            LecturePage::swapPages($idLecture, $pageOrder, $pageOrder + 1);
        }

        return $this->renderPartial('_pagesList', array('idLecture' => $idLecture, 'idCourse' => $idCourse));
    }

    public function actionUpdateLectureImage($id)
    {
        $model = Lecture::model()->findByPk($id);
        if (isset($_POST['Lecture'])) {
            $model->oldLogo = $model->image;
            if (!empty($_FILES['Lecture']['name']['image'])) {
                $model->logo = $_FILES['Lecture'];
                if ($model->validate()) {
                    $ext = substr(strrchr($_FILES['Lecture']['name']['image'], '.'), 1);
                    $_FILES['Lecture']['name']['image'] = uniqid() . '.' . $ext;
                    if (copy($_FILES['Lecture']['tmp_name']['image'], Yii::getpathOfAlias('webroot') . "/images/lecture/" . $_FILES['Lecture']['name']['image'])) {
                        $src = Yii::getPathOfAlias('webroot') . "/images/lecture/" . $model->oldLogo;
                        if (is_file($src) && $model->oldLogo != 'lectureImage.png')
                            unlink($src);
                    }
                    $model->updateByPk($id, array('image' => $_FILES['Lecture']['name']['image']));

                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/lecture/" . $_FILES['Lecture']['name']['image'],
                        Yii::getPathOfAlias('webroot') . "/images/lecture/share/shareLectureImg_" . $id . '.' . $ext,
                        210
                    );

                    $this->redirect(Yii::app()->request->urlReferrer);
                } else {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

    }

    public function actionEditBlock()
    {
        $order = Yii::app()->request->getPost('order');
        $lecture = Yii::app()->request->getPost('lecture');
        $html = LectureElement::model()->findByAttributes(array('block_order' => $order, 'id_lecture' => $lecture))->html_block;
        echo $html;
    }


    public function actionEditPage($id, $page, $idCourse){
        $pageModel = LecturePage::model()->findByAttributes(array('id_lecture' => $id, 'page_order' => $page));

        $textList = LecturePage::getBlocksListById($pageModel->id);

        $criteria = new CDbCriteria();
        $criteria->addInCondition('id_block', $textList);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );

        $lecture = Lecture::model()->findByPk($id);

        $this->render('/editor/index', array(
                'user' => Yii::app()->user->getId(),
                'page' => $pageModel,
                'dataProvider' => $dataProvider,
                'idCourse' => $idCourse,
                'lecture' =>$lecture,
            )
        );
    }
    public function actionPageAjaxUpdate()
    {

        $user=Yii::app()->user->getId();
        $id=$_GET['lectureId'];
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
            echo $this->renderPartial('/lesson/_page',array('id'=>$id,'page'=>$page,'dataProvider'=>$dataProvider,'user'=>$user,'finishedLecture'=>$finishedLecture,'passedLecture'=>$passedLecture,'passedPages'=>$passedPages, 'thisPage'=>$thisPage, 'edit'=>0,  'editMode' => $editMode),false,true);
        }
    }

    public function actionSaveBlock()
    {
        $order = Yii::app()->request->getPost('order');
        $id = Yii::app()->request->getPost('idLecture');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $id, 'block_order' => $order));
        $model->html_block = Yii::app()->request->getPost('content');

        $model->save();
    }
}