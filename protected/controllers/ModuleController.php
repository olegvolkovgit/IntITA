<?php

class ModuleController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Lists all models.
     * @throws CHttpException
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionIndex($idModule, $idCourse=0)
    {
        $model = Module::model()->findByPk($idModule);
        $moduleTeachers = $model->getModuleTeachers();

        $this->checkModelInstance($model);

        if($model->cancelled && !Yii::app()->user->model->isAdmin()) {
            throw new CHttpException(403, 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном адміністратора.');
        }
        
        $this->render('index', array(
            'post' => $model,
            'teachers' => $moduleTeachers,
            'idCourse' => $idCourse,
        ));
    }

    public function actionSchemes($id)
    {
        $model = Module::model()->findByPk($id);
        if ($model->cancelled == Module::DELETED) {
            throw new \application\components\Exceptions\IntItaException('410', Yii::t('error', '0786'));
        }

        $this->render('schemes', array(
            'model' => $model,
        ));

    }

    public function actionModuleData()
    {
        $data=array();
        
        $idModule = Yii::app()->request->getPost('moduleId');
        $idCourse = Yii::app()->request->getPost('courseId');
        $idUser=Yii::app()->user->getId();

        $module = Module::model()->findByPk($idModule);

        if($idCourse){
            $data['idCourse']=$idCourse;
            $course=Course::model()->findByPk($idCourse);
            $data['canPayCourse']=($course->status_online || $course->status_offline) && !$course->cancelled;
            $isReadyCourse=$course->status_online || $course->status_offline;
        }else{
            $isReadyCourse=true;
        }

        if (!Yii::app()->user->isGuest) {
            if(isset($course)){
                $isPaidCourse=$course->checkPaidAccess($idUser);
            }else{
                $isPaidCourse=false;
            }

            $data['user']['isPaidModule']=$module->checkPaidAccess($idUser);
            $data['user']['isPaidCourse']=$isPaidCourse;
            $data['user']['isContentManager']=Yii::app()->user->model->isContentManager();
            $data['user']['isAdmin']=Yii::app()->user->model->isAdmin();
            $data['user']['canSendRequest']=Yii::app()->user->model->canSendRequest($module->module_ID);
            $data['user']['isAuthor'] = Yii::app()->user->model->isAuthorModule($idModule);
            $data['user']['lastAccessLectureOrder'] = $module->getLastAccessLectureOrder();
        }

        $data['module']=ActiveRecordToJSON::toAssocArray($module);
        $data['canPayModule']=$module->status && !$module->cancelled;
        $data['moduleTitle']=$module->getTitle();
        $data['modulePrice']=$module->modulePrice($idCourse);
        $data['isReadyCourse']=$isReadyCourse;
        $data['lectures']=ActiveRecordToJSON::toAssocArray($module->lectures);

        if (!Yii::app()->user->isGuest) {
            if (!Yii::app()->user->model->coworkerHasModuleAccess($module)) {
                if(!$module->getModuleStatus($idCourse)){
                    $data['moduleAccess']=false;
                    $data['notAccessMessage']=$module->errorMessage;
                } else if(!$module->checkPaidAccess($idUser)){
                    $data['notAccessMessage']=Yii::t('exception', '0869');
                }

            }else{
                $data['moduleAccess']=true;
            }
        }else{
            $data['moduleAccess']=false;
            $data['notAccessMessage']=Yii::t('exception', '0868');
        }
        
        
        echo json_encode($data);
    }

    public function actionEdit($idModule, $idCourse=0)
    {
        $this->layout='modulelayout';

        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        }

        $model = Module::model()->with('teacher', 'lectures')->findByPk($idModule);

        $this->checkModelInstance($model);

        $editMode = Yii::app()->user->model->isAuthorModule($idModule);

        if(!$editMode) {
            throw new \application\components\Exceptions\IntItaException('403', 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном автора модуля.');
        }

        $this->render('edit', array(
            'module' => $model,
            'idCourse' => $idCourse,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Module the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Module::model()->findByPk($id);

        $this->checkModelInstance($model);

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Module $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'modules-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionSaveLesson()
    {
        $newLectureParams = array (
            'titleUa' => Yii::app()->request->getParam('titleUa', ''),
            'titleRu' => Yii::app()->request->getParam('titleRu', ''),
            'titleEn' => Yii::app()->request->getParam('titleEn', ''),
            'order' => Yii::app()->request->getParam('order', 1)
        );

        //throw error if idModule is '0' or unset?
        $idModule = Yii::app()->request->getParam('idModule');

        $model = Module::model()->findByPk($idModule);

        $this->checkModelInstance($model);

        $lecture = $model->addLecture($newLectureParams);

        Yii::app()->user->setFlash('newLecture', 'Нова лекція №' . $lecture->order . $lecture->title_ua . 'додана до цього модуля');

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * @throws CHttpException
     * @throws \application\components\Exceptions\ModuleValidationException
     */
    public function actionSaveModule()
    {
        $titleUa = Yii::app()->request->getPost('titleUA', '');
        $titleRu = Yii::app()->request->getPost('titleRU', '');
        $titleEn = Yii::app()->request->getPost('titleEN', '');
        $idCourse = Yii::app()->request->getPost('idCourse');
        $lang = Yii::app()->request->getPost('lang');
        $author = Yii::app()->request->getPost('isAuthor', 0);

        $course = Course::model()->with("module")->findByPk($idCourse);

        $module = new Module();
        $module->initNewModule($course, $titleUa, $titleRu, $titleEn, $lang);

        if ($module !== null) {
            $course->updateCount();
        }

        if($author != 0){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new MessagesAuthorRequest();
                $model = StudentReg::model()->findByPk($author);
                $message->build($module, $model);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
            } catch (Exception $e){
                $transaction->rollback();
                throw new \application\components\Exceptions\IntItaException(500, "Запит на редагування модуля не вдалося надіслати.");
            }
        }
        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->actionIndex($module->module_ID, $course->course_ID);
    }

    public function actionSendRequest($user, $moduleId){
        $module = Module::model()->findByPk($moduleId);
        $model = StudentReg::model()->findByPk($user);

        if($model && $module){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new MessagesAuthorRequest();
                $message->build($module, $model);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
                echo "Запит на редагування модуля успішно відправлено. Зачекайте, поки адміністратор сайта підтвердить запит.";
            } catch (Exception $e){
                $transaction->rollback();
                throw new \application\components\Exceptions\IntItaException(500, "Запит на редагування модуля не вдалося надіслати.");
            }
        }
    }

    /**
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionUnableLesson()
    {
        $idLecture = Yii::app()->request->getParam('idLecture');
        $idCourse = Yii::app()->request->getParam('idModule');

        $model = Module::model()->with('lectures')->findByPk($idCourse);

        $this->checkModelInstance($model);

        $model->disableLesson($idLecture);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionUpLesson()
    {
        $idLecture = Yii::app()->request->getParam('idLecture');
        $idModule = Yii::app()->request->getParam('idModule');

        $module = Module::model()->with('lectures')->findByPk($idModule);

        $this->checkModelInstance($module);

        $module->upLecture($idLecture);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionDownLesson()
    {
        $idLecture = Yii::app()->request->getParam('idLecture');
        $idModule = Yii::app()->request->getParam('idModule');

        $module = Module::model()->with('lectures')->findByPk($idModule);

        $this->checkModelInstance($module);

        $module->downLecture($idLecture);

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUpdateModuleAttribute()
    {
        $up = new EditableSaver('Module');
        $up->update();
    }

    public function actionUpdateModuleImage($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Module'])) {
            $imageName = $_FILES['Module']['name']['module_img'];
            $tmpName = $_FILES['Module']['tmp_name']['module_img'];
            if (!empty($imageName)) {
                $model->logo = $_FILES['Module'];
                if ($model->validate()) {
                    Avatar::updateModuleAvatar($imageName,$tmpName,$id,$model->oldLogo);
                    $this->redirect(Yii::app()->request->urlReferrer);
                }else {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }

    }

    /**
     * @param $model
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    private function checkModelInstance($model) {
        if ($model === null)
            throw new \application\components\Exceptions\ModuleNotFoundException();
    }

    public function actionGetTagsList()
    {
        echo Tags::tagsList();
    }

    public function actionGetModuleTags() {
        $idModule = Yii::app()->request->getPost('idModule');
        $module = Module::model()->findByPk($idModule);
        echo $module->moduleTags();
    }
    
    public function actionCreate()
    {
        $module = new Module;

        $titleUa = Yii::app()->request->getPost('titleUA', '');
        $titleRu = Yii::app()->request->getPost('titleRU', '');
        $titleEn = Yii::app()->request->getPost('titleEN', '');
        $lang = Yii::app()->request->getPost('language');
        $author = Yii::app()->request->getPost('isAuthor', 0);
        $moduleTags = Yii::app()->request->getPost('moduleTags');

        $module->language = $lang;
        $module->title_ua = $titleUa;
        $module->title_ru = $titleRu;
        $module->title_en = $titleEn;
        $module->level = 3;

        if ($module->save()) {
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$module->module_ID)){
                mkdir(Yii::app()->basePath . "/../content/module_".$module->module_ID);
            }
            Module::model()->updateByPk($module->module_ID, array('module_img' => 'module.png'));
        } else {
            throw new \application\components\Exceptions\IntItaException(400, 'Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.');
        }

        ModuleTags::model()->editModuleTags($moduleTags,$module->module_ID);

        if($author != 0){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new MessagesAuthorRequest();
                $model = StudentReg::model()->findByPk($author);
                $message->build($module, $model);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
            } catch (Exception $e){
                $transaction->rollback();
                echo "Запит на редагування модуля не вдалося надіслати.";
                Yii::app()->end();
            }
        }
    }

    public function actionEditModuleTags()
    {
        $idModule = Yii::app()->request->getPost('idModule');
        $moduleTags = Yii::app()->request->getPost('moduleTags');
        ModuleTags::model()->editModuleTags($moduleTags,$idModule);
    }

    public function actionAddTag() {
        $moduleId = Yii::app()->request->getPost('idModule');
        $tags = Yii::app()->request->getPost('tag');
        $module = Module::model()->findByPk($moduleId);
        $addedTagsArray = [];
        if ($module) {
            foreach ($tags as $tag) {
                $tag = Tags::model()->findOrCreateTag($tag['id'], $tag['tag']);
                $module->addTag($tag);
                array_push($addedTagsArray, $tag->getTagAttrs());
            }
        }
        $this->renderPartial('//ajax/json', ['statusCode' => 201, 'body' => json_encode($addedTagsArray)]);
    }

    public function actionRemoveTag() {
        $moduleId = Yii::app()->request->getPost('idModule');
        $tagId = Yii::app()->request->getPost('tagId');
        $module = Module::model()->findByPk($moduleId);
        $tag = Tags::model()->findByPk($tagId);
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $response = [];
        if ($module->removeTag($tag)) {
            $response[] = $tag->getTagAttrs($lang);
        };
        $this->renderPartial('//ajax/json', ['statusCode' => 200, 'body' => json_encode($response)]);
    }

    public function actionGetTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'Module', ['title_ua', 'title_ru', 'title_en']);
        $array = ActiveRecordToJSON::toAssocArray($models);
        echo json_encode($array);
    }

    public function actionGetModuleTitle($id)
    {
        $model=Module::model()->findByPk($id);
        echo $model->title_ua.' ('.$model->language.')';
    }
}
