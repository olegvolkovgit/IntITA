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

    public function init()
    {
        $app = Yii::app();
        if (isset($app->session['lg'])) {
            $app->language = $app->session['lg'];
        }
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        }else return true;
    }

    public function initialize($id, $idCourse=0)
    {
        $lecture = Lecture::model()->findByPk($id);
        if(!$lecture)
            throw new \application\components\Exceptions\IntItaException('404', Yii::t('lecture', '0810'));
        if(!Yii::app()->user->model->hasLectureAccess($lecture, $idCourse))
            throw new \application\components\Exceptions\IntItaException('403', Yii::app()->user->model->lectureAccessErrorMessage);
        return true;
    }

    public function actionIndex($id, $idCourse = 0, $page = 1)
    {
        $lecture = Lecture::model()->findByPk($id);

        if (Yii::app()->user->isGuest) {
            $user = 0;
        } else {
            $user = Yii::app()->user->getId();
        }

        $editMode = Yii::app()->user->model->isAuthorModule($lecture->idModule);

        $this->initialize($id, $idCourse);

//        create module progress if there are no record
        $lecture->module->createRatingUserModuleRecord();

        $passedPages = $lecture->accessPages($user, $editMode, Yii::app()->user->model->hasAccessToContent($lecture->module));

        $lastAccessPage = LecturePage::lastAccessPage($passedPages) + 1;

        if ($editMode) $page = 1;
        else $page = $lastAccessPage;

        if (isset($_GET['editPage'])) {
            $page = $_GET['editPage'];
        }
        if (is_string($_GET['page'])) {
            $page = $_GET['page'];
        }

        if(!isset($lecture->pages[$page-1])){
            throw new \application\components\Exceptions\IntItaException('404', Yii::t('lecture', '0812'));
        }
        $pageModel=$lecture->pages[$page-1];

        $textList = $pageModel->getBlocksListById();

        $dataProvider = LectureElement::getLectureText($textList);

        $isLastLecture=$lecture->isLastLecture();

        $this->setUserLastLink();

        $this->render('index', array(
            'isVerified'=>$lecture->verified,
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,
            'editMode' => $editMode,
            'passedPages' => $passedPages,
            'idCourse' => $idCourse,
            'user' => $user,
            'page' => $pageModel,
            'lastAccessPage' => $lastAccessPage,
            'isLastLecture' => $isLastLecture,
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

        $model = new LectureElement();
        $model->addVideo($htmlBlock, $pageOrder, $lectureId);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddFormula()
    {
        $htmlBlock = Yii::app()->request->getPost('newFormula');
        $pageOrder = Yii::app()->request->getPost('page');
        $idLecture = Yii::app()->request->getPost('idLecture');

        $model = new LectureElement();
        $model->addFormula($htmlBlock, $pageOrder, $idLecture);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateNewBlock()
    {
        $pageOrder = Yii::app()->request->getPost('page');
        $idType = Yii::app()->request->getPost('type');
        $htmlBlock = Yii::app()->request->getPost('newTextBlock');
        $idLecture = Yii::app()->request->getPost('idLecture');

        $lecture = Lecture::model()->findByPk($idLecture);

        $this->checkInstanse($lecture);

        $lecture->createNewBlock($htmlBlock, $idType, $pageOrder);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCreateNewBlockCKE()
    {
        $pageOrder = Yii::app()->request->getPost('page');
        $idType = Yii::app()->request->getPost('type');
        $htmlBlock = Yii::app()->request->getPost('editorAdd');

        $idLecture = Yii::app()->request->getPost('idLecture');

        $lecture = Lecture::model()->with("lectureEl")->findByPk($idLecture);

        $this->checkInstanse($lecture);

        $lecture->createNewBlockCKE($htmlBlock, $idType, $pageOrder);

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block
    public function actionUpElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->upElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - down block
    public function actionDownElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->findByPk($idLecture);

        $lecture->downElement($order);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //delete block on lesson page
    public function actionDeleteElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        $lecture = Lecture::model()->with("lectureEl")->findByPk($idLecture);

        $this->checkInstanse($lecture);

        $lecture->deleteLectureElement($order);

        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //delete block on lesson page
    public function actionDeleteVideo()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');

        $modelLecturePage = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $pageOrder));
        if ($modelLecturePage->video) {
            $elementId = $modelLecturePage->video;
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
            $filename = uniqid() . '.jpg';
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

    public function actionUploadBase64ToImage()
    {
        $base64str = $_POST['base64'];
        $base64pos = strpos($base64str, 'base64,');
        //base64, -7 chars
        $base64 = base64_decode(substr($base64str, $base64pos + 7));
        $base64type = substr($base64str, 5, $base64pos - 6);
        $imgType = substr($base64type, 6);

        $path = StaticFilesHelper::createLectureImagePath();
        $dir = Yii::getpathOfAlias('webroot') . $path;
        $filename = uniqid() . '.' . $imgType;
        $file = $dir . $filename;
        $link = StaticFilesHelper::createPath('image', 'lecture', $filename);

        if ($base64type == 'image/png'
            || $base64type == 'image/jpg'
            || $base64type == 'image/gif'
            || $base64type == 'image/jpeg'
            || $base64type == 'image/pjpeg'
        ) {
            $fpng = fopen($file, "w");
            fwrite($fpng, $base64);
            fclose($fpng);
            echo $link;
        } else {
            echo 'error';
        }
    }

    public function actionCKEUploadImageAudio()
    {
        if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
            define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename(md5(md5($_FILES['upload']['name'])))) . uniqid());  //get filename without extension
        }
        $pathImage = StaticFilesHelper::pathToImagesContent(F_NAME);
        $pathAudio = StaticFilesHelper::pathToAudioContent(F_NAME);

        // PHP Upload Script for CKEditor:  http://coursesweb.net/

// HERE SET THE PATH TO THE FOLDERS FOR IMAGES AND AUDIO ON YOUR SERVER (RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER)
        $upload_dir = array(
            'img' => Config::getBaseUrl() .'/'. $pathImage,
            'audio' => Config::getBaseUrl() .'/'. $pathAudio
        );

// HERE PERMISSIONS FOR IMAGE
        $imgset = array(
            'maxsize' => 5 * 1024,     // maximum file size, in KiloBytes (2 MB)
            'maxwidth' => 5000,     // maximum allowed width, in pixels
            'maxheight' => 5000,    // maximum allowed height, in pixels
            'minwidth' => 1,      // minimum allowed width, in pixels
            'minheight' => 1,     // minimum allowed height, in pixels
            'type' => array('bmp', 'gif', 'jpg', 'jpeg', 'png'),  // allowed extensions
        );

// HERE PERMISSIONS FOR AUDIO
        $audioset = array(
            'maxsize' => 20000,    // maximum file size, in KiloBytes (20 MB)
            'type' => array('mp3', 'ogg', 'wav'),  // allowed extensions
        );

// If 1 and filename exists, RENAME file, adding "_NR" to the end of filename (name_1.ext, name_2.ext, ..)
// If 0, will OVERWRITE the existing file
        define('RENAME_F', 1);

        $re = '';
        if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
            // get protocol and host name to send the absolute image path to CKEditor
            $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $site = $protocol . $_SERVER['SERVER_NAME'] . '/';
            $sepext = explode('.', strtolower($_FILES['upload']['name']));
            $type = end($sepext);    // gets extension
            $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['audio'];
            $type_dir = in_array($type, $imgset['type']) ? $pathImage : $pathAudio;
            if(!file_exists(Yii::getpathOfAlias('webroot').'/'.$type_dir)){
                mkdir(Yii::getpathOfAlias('webroot').'/'.$type_dir);
            }
            $upload_dir = trim($upload_dir, '/') . '/';
            $dir = in_array($type, $imgset['type']) ? Yii::getpathOfAlias('webroot').'/'.$pathImage : Yii::getpathOfAlias('webroot').'/'.$pathAudio;

            //checkings for image or audio
            if (in_array($type, $imgset['type'])) {
                list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);  // image width and height
                if (isset($width) && isset($height)) {
                    if ($width > $imgset['maxwidth'] || $height > $imgset['maxheight']) $re .= '\\n Width x Height = ' . $width . ' x ' . $height . ' \\n The maximum Width x Height must be: ' . $imgset['maxwidth'] . ' x ' . $imgset['maxheight'];
                    if ($width < $imgset['minwidth'] || $height < $imgset['minheight']) $re .= '\\n Width x Height = ' . $width . ' x ' . $height . '\\n The minimum Width x Height must be: ' . $imgset['minwidth'] . ' x ' . $imgset['minheight'];
                    if ($_FILES['upload']['size'] > $imgset['maxsize'] * 1024) $re .= '\\n Maximum file size must be: ' . $imgset['maxsize'] . ' KB.';
                }
            } else if (in_array($type, $audioset['type'])) {
                if ($_FILES['upload']['size'] > $audioset['maxsize'] * 1024) $re .= '\\n Maximum file size must be: ' . $audioset['maxsize'] . ' KB.';
            } else $re .= 'The file: ' . $_FILES['upload']['name'] . ' has not the allowed extension type.';

            //set filename; if file exists, and RENAME_F is 1, set "img_name_I"
            // $p = dir-path, $fn=filename to check, $ex=extension $i=index to rename
            function setFName($p, $fn, $ex, $i)
            {
                if (RENAME_F == 1 && file_exists($p . $fn . $ex)) return setFName($p, F_NAME . '_' . ($i + 1), $ex, ($i + 1));
                else return $fn . $ex;
            }

            $f_name = setFName($_SERVER['DOCUMENT_ROOT'] . '/' . $dir, F_NAME, ".$type", 0);
            $uploadpath = $dir . $f_name;  // full file path

            // If no errors, upload the image, else, output the errors
            if ($re == '') {
                if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
                    $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                    $url = $upload_dir . $f_name;
                    $msg = F_NAME . '.' . $type . ' successfully uploaded: \\n- Size: ' . number_format($_FILES['upload']['size'] / 1024, 2, '.', '') . ' KB';
                    $re = in_array($type, $imgset['type']) ? "window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')"  //for img
                        : 'var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\'<div hello><audio src="' . $url . '" controls></audio></div>\', \'unfiltered_html\'); alert("' . $msg . '"); var dialog = cke_ob.dialog.getCurrent();  dialog.hide();';
                } else $re = 'alert("Unable to upload the file")';
            } else $re = 'alert("' . $re . '")';
        }

        @header('Content-type: text/html; charset=utf-8');
        echo '<script>' . $re . ';</script>';
    }

    public function actionFormulaRedactor()
    {
        $this->render('formulaRedactor');
    }

    public function actionNextPage($id, $idCourse = 0, $page)
    {
        $nextPage = LecturePage::getNextPage($id, $page);

        $this->redirect(Yii::app()->createUrl("lesson/index", array('id' => $id, 'idCourse' => $idCourse, 'page' => $nextPage)));
    }

    public function actionNextLecture()
    {
        $lectureId = $_POST ["params"]["lecture_id"];
        $idCourse = $_POST ["params"]["courses_id"];
        $revisions = RevisionLecture::getParentRevisionForLecture($lectureId);
        $lecture = Lecture::model()->findByPk($lectureId);
        $understand_rating = $_POST['params']['ratings']['0']['rate'];
        $interesting_rating = $_POST['params']['ratings']['1']['rate'];
        $accessibility_rating = $_POST['params']['ratings']['2']['rate'];
        $id_user = Yii::app()->user->getId();
        $isRatingExist = LecturesRating::model()->exists('id_user=:id_user and `id_lecture`=:id_lecture and                                                                             `id_revision`=:id_revision',
                                                        array('id_user'=> $id_user,
                                                              'id_lecture' => $lectureId,
                                                              'id_revision' => $revisions->id_revision
                                                            ));
        if($isRatingExist){
                // rewrite rating in LectureRating
            $oldRating = LecturesRating::model()->findByAttributes(array('id_user'=> $id_user, 'id_lecture' => $lectureId));
            $oldRating->understand_rating = $understand_rating;
            $oldRating->interesting_rating = $interesting_rating;
            $oldRating->accessibility_rating = $accessibility_rating;

            if($understand_rating < 5 || $interesting_rating < 5 || $accessibility_rating < 5){
                if(isset($_POST['params']['ratings']['comment'])){
                    $oldRating->comment = $_POST['params']['ratings']['comment'];
                }
            }else{
                $oldRating->comment = NULL;
            }
            $oldRating->save();

            $lecture->updateRatingLectures($understand_rating, 'understand_rating');
            $lecture->updateRatingLectures($interesting_rating, 'interesting_rating');
            $lecture->updateRatingLectures($accessibility_rating, 'accessibility_rating');
        }else if($understand_rating != 0 || $interesting_rating != 0 || $accessibility_rating != 0) {
                // save new rating in LectureRating
            $modelRating = new LecturesRating;
            $modelRating->id_lecture = $lectureId;
            $modelRating->understand_rating = $understand_rating;
            $modelRating->interesting_rating = $interesting_rating;
            $modelRating->accessibility_rating = $accessibility_rating;
            $modelRating->id_user = $id_user;
            $modelRating->id_revision = $revisions->id_revision;

            if(isset($_POST['params']['ratings']['comment'])){
                $modelRating->comment = $_POST['params']['ratings']['comment'];
            }
            $modelRating->save();

            $lecture->updateRatingLectures($understand_rating, 'understand_rating');
            $lecture->updateRatingLectures($interesting_rating, 'interesting_rating');
            $lecture->updateRatingLectures($accessibility_rating, 'accessibility_rating');
        }

        if(Yii::app()->request->isAjaxRequest){
            $data=array();
            if ($lecture->order < $lecture->lastLectureOrder()) {
                $nextId = $lecture->nextLectureId();
                $data['url'] = Yii::app()->createUrl('lesson/index', array('id' => $nextId, 'idCourse' => $idCourse));
                echo json_encode($data);
                // $lecture = Lecture::model()->updateByPk($idLecture, array('order' => 0));  // *** обновление старого поля
            } else {
                echo $_SERVER["HTTP_REFERER"];
            }
        }else{
            if ($lecture->order < $lecture->lastLectureOrder()) {
                $nextId = $lecture->nextLectureId();  // old
                $this->redirect(Yii::app()->createUrl('lesson/index', array('id' => $nextId, 'idCourse' => $idCourse)));  // old
            } else {
                $this->redirect($_SERVER["HTTP_REFERER"]);  // old
            }
        }
    }

    public function actionAverageRatingLecture($idModule)
    {
        echo Lecture::getAverageRatingLecture($idModule);
    }

    public function actionAverageRatingModule()
    {
        $idModule = $_POST['idModule'];
        echo Lecture::getAverageRatingModule($idModule);
    }

    public function actionSaveRatingModule(){
        $data = array_filter($_POST);
        $idModule = $data['params']['idModule'];
        $understand_rating = $data['params']['ratings']['0']['rate'];
        $interesting_rating = $data['params']['ratings']['1']['rate'];
        $accessibility_rating = $data['params']['ratings']['2']['rate'];
        $module = Module::model()->findByPk($idModule);
        $id_user = Yii::app()->user->getId();

        $isRatingExist = ModuleRating::model()->exists('id_module=:id_module and `id_module_revision`=:id_module_revision and                                                           `id_user`=:id_user',
                                                       array('id_module' => $idModule,
                                                             'id_module_revision' => $module->id_module_revision,
                                                             'id_user' => $id_user
                                                           ));

        if($isRatingExist){
            $oldRating = ModuleRating::model()->findByAttributes(array('id_user'=>$id_user, 'id_module'=>$idModule));
            $oldRating->understand_rating = $understand_rating;
            $oldRating->interesting_rating = $interesting_rating;
            $oldRating->accessibility_rating = $accessibility_rating;

            if($understand_rating < 5 || $interesting_rating < 5 || $accessibility_rating < 5){
                if(isset($_POST['params']['ratings']['comment'])){
                    $oldRating->comment = $_POST['params']['ratings']['comment'];
                }
            }else{
                $oldRating->comment = NULL;
            }
            $oldRating->save();

        }else if($understand_rating != 0 || $interesting_rating != 0 || $accessibility_rating != 0){
            $moduleRating = new ModuleRating;
            $moduleRating->id_user = $id_user;
            $moduleRating->id_module = $idModule;
            $moduleRating->understand_rating = $understand_rating;
            $moduleRating->interesting_rating = $interesting_rating;
            $moduleRating->accessibility_rating = $accessibility_rating;
            $moduleRating->id_module_revision = $module->id_module_revision;

            if(isset($_POST['params']['ratings']['comment'])){
                $moduleRating->comment = $_POST['params']['ratings']['comment'];
            }

            $moduleRating->save();
        }
    }

    public function actionGetOldRating($id_lecture)
    {
        $id_user = Yii::app()->user->getId();
        echo Lecture::getRatingData($id_lecture, $id_user);
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

    public function actionDeletePage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture', 0);
        $pageOrder = Yii::app()->request->getPost('pageOrder', 1);

        LecturePage::deletePage($idLecture, $pageOrder);
        LecturePage::reorderPages($idLecture, $pageOrder);
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

        if ($pageOrder > 1) {
            LecturePage::swapPages($idLecture, $pageOrder - 1, $pageOrder);
        }
    }

    //reorder blocks on lesson page - down block
    public function actionDownPage()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $pageOrder = Yii::app()->request->getPost('pageOrder');

        if ($pageOrder < LecturePage::model()->count('id_lecture=' . $idLecture)) {
            LecturePage::swapPages($idLecture, $pageOrder, $pageOrder + 1);
        }
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

    public function actionSaveBlock()
    {
        $order = Yii::app()->request->getPost('order');
        $id = Yii::app()->request->getPost('idLecture');

        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $id, 'block_order' => $order));
        $model->html_block = Yii::app()->request->getPost('content');

        if ($model->validate()) {
            $model->save();
        } else echo Yii::t('lecture', '0814');
    }

    public function actionSaveLectureContent($idLecture)
    {
        $model = Lecture::model()->findByPk($idLecture);
        $model->saveLectureContent();
        $this->redirect(Config::getBaseUrl() . '/_teacher/cabinet/index');
    }
    public function actionDeleteLectureContent($idLecture)
    {
        $model = Lecture::model()->findByPk($idLecture);
        $model->deleteLectureContent();
        $this->redirect(Config::getBaseUrl() . '/_teacher/cabinet/index');
    }

    public function actionGetPageData()
    {
        $user = Yii::app()->user->getId();
        $id = Yii::app()->request->getPost('lecture');

        $lecture = Lecture::model()->findByPk($id);
        $pagesAccess=Yii::app()->user->model->hasLecturePagesAccess($lecture);
        $passedPages = LecturePage::getAccessPages($id, $user, $pagesAccess);

        echo json_encode($passedPages);
    }

    public function actionGetAccessLectures()
    {
        $data=array();

        $lecture = Lecture::model()->findByPk(Yii::app()->request->getPost('lectureId'));
        $courseId = Yii::app()->request->getPost('courseId');
        $module = Module::model()->with('lectures')->findByPk($lecture->idModule);

        $data['lastAccessLectureOrder'] = $module->getLastAccessLectureOrder();
        $data['module']=ActiveRecordToJSON::toAssocArrayWithRelations($module);
        $data['courseId']=$courseId;
        foreach ($module->lectures as $key=>$l){
            if($l->id==$lecture->id){
                $data['currentOrder']=$key+1;
                break;
            }
        }

        echo json_encode($data);
    }

    public function actionSaveFormulaImage()
    {
        $imageUrl = $_POST['imageUrl'];
        $name=md5(md5($imageUrl)).uniqid();
        $path =  StaticFilesHelper::pathToImagesContent($name);
        $dir = Yii::getpathOfAlias('webroot') .'/'. $path;
        $filename = $name . '.gif';
        $file = $dir . $filename;
        $link = Config::getBaseUrl().'/'.StaticFilesHelper::pathToImagesContent($name).$filename;
        if(!file_exists($dir)){
            mkdir($dir);
        }
        copy($imageUrl, $file);
        echo $link;
    }

    public function actionLoadVideoPage()
    {
        $user = Yii::app()->user->getId();
        $id = $_GET['lectureId'];
        $actualOrder = $_GET['page'];
        $lecture = Lecture::model()->findByPk($id);

        $lecture->module->checkPaidModuleAccess($user);

        $page=$lecture->pages[$actualOrder-1];

        echo $this->renderPartial('/lesson/_videoTab',
            array('page' => $page), true);
    }

    public function actionLoadTextPage()
    {
        $user = Yii::app()->user->getId();
        $id = $_GET['lectureId'];
        $lecture = Lecture::model()->findByPk($id);
        $actualOrder = $_GET['page'];
        $editMode = Teacher::isTeacherAuthorModule($user, $lecture->idModule);

        $lecture->module->checkPaidModuleAccess($user);

        $page=$lecture->pages[$actualOrder-1];

        $textList = $page->getBlocksListById();

        $dataProvider = LectureElement::getLectureText($textList);

        echo $this->renderPartial('/lesson/_textListTab',
            array('dataProvider' => $dataProvider, 'editMode' => $editMode, 'user' => $user), true);
    }

    public function actionLoadQuizPage()
    {
        $user = Yii::app()->user->getId();
        $id = $_GET['lectureId'];
        $actualOrder = $_GET['page'];
        $lecture = Lecture::model()->findByPk($id);
        $editMode = Teacher::isTeacherAuthorModule($user,$lecture->idModule);

        $lecture->module->checkPaidModuleAccess($user);

        $page=$lecture->pages[$actualOrder-1];

        echo $this->renderPartial('/lesson/_quiz',
            array('page' => $page, 'editMode' => $editMode, 'user' => $user), true);
    }

    public function actionConfirm($id){
        $model = Lecture::model()->findByPk($id);

        if ($model){
            $model->updateByPk($id, array('verified' => '1'));
            $model->saveLectureContent();
        } else {
            throw new CException("Такої лекції немає!");
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCancel($id){
        $model = Lecture::model()->findByPk($id);

        if ($model){
            $model->verified = 0;
            $model->save();
        } else {
            throw new CException("Такої лекції немає!");
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    private function checkInstanse($model) {
        if ($model === null)
            throw new \application\components\Exceptions\LessonNotFoundException();
    }

    public function actionGetModulesLastPage(){
        $user = Yii::app()->user->getId();
        $idModule = Yii::app()->request->getPost('moduleId');
        $module=Module::model()->findByPk($idModule);
        $editMode = Yii::app()->request->getPost('editMode');

        $lastLecture=$module->lastLecture();
        $lastLecturePassedPages=$lastLecture->accessPages($user, $editMode, Yii::app()->user->model->isAdmin());

        $lectures['lectures']=$lastLecturePassedPages;
        $lectures['icoPath']=StaticFilesHelper::createPath('image', 'lecture', '');

        echo json_encode($lectures);
    }

    private function setUserLastLink() {
        $userLastLink=UserLastLink::model()->findByPk(Yii::app()->user->getId());
        if($userLastLink){
            $userLastLink->last_link=$_SERVER['REQUEST_URI'];
            $userLastLink->update();
        }else{
            $userLastLink= new UserLastLink();
            $userLastLink->id_user=Yii::app()->user->getId();
            $userLastLink->last_link=$_SERVER['REQUEST_URI'];
            $userLastLink->save();
        }
    }

    public function actionGetLectureLink($idLecture, $idCourse=0)
    {
        echo Yii::app()->createUrl("lesson/index", array("id" => $idLecture, "idCourse" => $idCourse));
    }
}