<?php
class TmanageController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('delete', 'create', 'update', 'view', 'index', 'admin', 'roles', 'createRole',
                    'showRoles', 'addRoleAttribute'),
                'expression' => array($this, 'isAdministrator'),
            ),
            array('deny',
                'message' => "У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions' => array('delete', 'create', 'update', 'view', 'index', 'admin', 'roles', 'createRole',
                    'showRoles', 'addRoleAttribute'),
                'users' => array('*'),
            ),
        );
    }

    function isAdministrator()
    {
        if (AccessHelper::isAdmin())
            return true;
        else
            return false;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Teacher;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Teacher'])) {
            $_POST['Teacher']['foto_url'] = $_FILES['Teacher']['name']['foto_url'];
            $fileInfo=new SplFileInfo($_POST['Teacher']['foto_url']);
            $model->attributes = $_POST['Teacher'];
            $model->avatar = $_FILES['Teacher'];
            if ($model->save()) {
                ImageHelper::uploadAndResizeImg(
                    Yii::getPathOfAlias('webroot')."/images/teachers/".$_FILES['Teacher']['name']['foto_url'],
                    Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_".$model->teacher_id.'.'.$fileInfo->getExtension(),
                    200
                );
                StudentReg::model()->updateByPk($_POST['Teacher']['user_id'], array('role' => 1));
                $this->redirect(array('view', 'id' => $model->teacher_id));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Teacher'])) {
            $model->oldAvatar = $model->foto_url;
            $_POST['Teacher']['foto_url'] = $_FILES['Teacher']['name']['foto_url'];
            $fileInfo=new SplFileInfo($_POST['Teacher']['foto_url']);
            $model->attributes = $_POST['Teacher'];
            $model->avatar = $_FILES['Teacher'];
            if ($model->save())
                ImageHelper::uploadAndResizeImg(
                    Yii::getPathOfAlias('webroot')."/images/teachers/".$_FILES['Teacher']['name']['foto_url'],
                    Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_".$model->teacher_id.'.'.$fileInfo->getExtension(),
                    200
                );
                $this->redirect(array('view', 'id' => $model->teacher_id));
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Teacher');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Teacher('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Teacher']))
            $model->attributes = $_GET['Teacher'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Teacher the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Teacher::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Teacher $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    public function actionRoles()
    {
        $dataProvider = new CActiveDataProvider('Roles');
        $this->render('roles', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateRole()
    {
        $model = new Roles;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];

            if ($model->save()) {
                $this->render('viewRole', array('model' => $model));
            }
        }
        $this->render('createRole', array(
            'model' => $model,
        ));
    }

    public function actionShowRoles($id)
    {

        $roles = TeacherRoles::model()->findAllByAttributes(array('teacher' => $id));

        $name = Teacher::getFullName($id);
        $this->render('showRoles', array(
            'roles' => $roles,
            'name' => $name,
            'teacherId' => $id,
        ));
    }

    public function actionAddRoleAttribute($role)
    {
        $model = new RoleAttribute;
        if (isset($_POST['RoleAttribute'])) {
            $model->attributes = $_POST['RoleAttribute'];
            if ($model->save())
                $this->redirect(array('showAttributes', 'role'=>$model->role));
        }
        $model->role = $role;
        $this->render('addRoleAttribute', array(
            'model' => $model,
        ));
    }

    public function actionShowAttributes($role)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'role=' . $role;
        $dataProvider = new CActiveDataProvider('RoleAttribute', array(
            'criteria' => $criteria,
        ));

        $model = Roles::model()->findByPk($role);

        $this->render('showRoleAttributes', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddTeacherRole($teacher){
        $this->render('addTeacherRole', array(
            'teacher' => $teacher,
        ));
    }

    public function actionAddTeacherRoleAttribute($teacher){
        $this->render('addTeacherRoleAttribute', array(
            'teacher' => $teacher,
        ));
    }

    public function actionViewRole($id)
    {
        $this->render('viewRole',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionUpdateRole($id)
    {
        $model= Roles::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Roles']))
        {
            $model->attributes=$_POST['Roles'];
            if($model->save())
                $this->redirect(array('tmanage/roles'));
        }

        $this->render('updateRole',array(
            'model'=>$model,
        ));
    }
}