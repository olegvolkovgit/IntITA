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

        $this->checkModelInstance($model);

        if($model->cancelled && !StudentReg::isAdmin()) {
            throw new CHttpException(403, 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном адміністратора.');
        }

        $editMode = 0;
        $isPaidCourse=false;
        $isPaidModule=false;
        if (!Yii::app()->user->isGuest) {
            $userId=Yii::app()->user->getID();
            $author = new Author();
            if(Yii::app()->user->model->isAuthor()) {
                $editMode = $author->isTeacherAuthorModule($userId, $idModule);
            }
            if($idCourse!=0 && PayCourses::model()->checkCoursePermission($userId, $idCourse, array('read'))){
                $isPaidCourse=true;
            }
            if(PayModules::model()->checkModulePermission($userId, $idModule, array('read'))){
                $isPaidModule=true;
            }
        }
        if($idCourse!=0){
            $isReadyCourse=Course::model()->findByPk($idCourse)->status;
        }else{
            $isReadyCourse=true;
        }

        $this->render('index', array(
            'post' => $model,
            'teachers' => $model->teacher,
            'editMode' => $editMode,
            'lecturesTitles' => $model->lectures,
            'dataProvider' => $model->getLecturesDataProvider(),
            'idCourse' => $idCourse,
            'isPaidCourse' => $isPaidCourse,
            'isPaidModule' => $isPaidModule,
            'isReadyCourse' => $isReadyCourse,
        ));
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

        $editMode = false;
        $author = new Author();
        if(Yii::app()->user->model->isAuthor()) {
            $editMode = $author->isTeacherAuthorModule(Yii::app()->user->getID(), $idModule);
        }

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

    /**
     * @throws CException
     * @throws \application\components\Exceptions\ModuleNotFoundException
     */
    public function actionLecturesUpdate()
    {
        $idModule = Yii::app()->request->getParam('idmodule');

        $model = Module::model()->findByPk($idModule);

        $this->checkModelInstance($model);

        $this->renderPartial('_addLessonForm', array('model' => $model), false, true);
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
    public function actionModuleData()
    {
        $data = [];
        $model = Module::model()->with('teacher', 'lectures')->findByPk(Yii::app()->request->getPost('id'));
        $modelData=get_object_vars($model->getLecturesDataProvider());

        for($i = 0;$i < count($modelData['rawData']);$i++){
            $data['lecturesLink'][$i]=Yii::app()->createUrl("lesson/index", array("id" => $modelData['rawData'][$i]['id'], "idCourse" => 0));
        }
        $fullData=CJSON::encode(array_merge($modelData,$data));

        echo $fullData;
    }

    public function actionAddAccessFreeModule(){
        $userId = Yii::app()->request->getPost('user', 0);
        $moduleId = Yii::app()->request->getPost('module', 0);

        $user = StudentReg::model()->findByPk($userId);
        $module = Module::model()->findByPk($moduleId);

        if($user && $module){
            $exist = PayModules::model()->findByAttributes(array('id_user' => $userId, 'id_module' => $moduleId));
            if (!empty($exist)) {
               echo "У тебе вже є доступ до цього модуля.";
                Yii::app()->end();
            } else {
                $permission = new PayModules();
                $permission->setModuleRead($user->id, $module->module_ID);
                if (!UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module->module_ID)) {
                    UserAgreements::agreementByParams('Module', $user->id, $module->module_ID, 0, 1, 'Online');
                }
                $message = new MessagesPayment();
                $message->build(null, $user, $module);
                $message->create();

                $sender = new MailTransport();
                $message->send($sender);
                echo "Вітаємо!<br> Тепер у тебе є доступ до усіх матеріалів цього модуля.";
            }
        } else {
            echo Yii::t('breadcrumbs', '0781');
        }
    }
}
