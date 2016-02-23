<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:05
 */

class TeachersController extends TeacherCabinetController{

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function performAttributeRoleAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'role-attribute-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionIndex()
    {
        $model = new Teacher('search');
        $model->unsetAttributes();

        if (isset($_GET['Teacher']))
            $model->attributes = $_GET['Teacher'];

        $this->renderPartial('index', array(
            'model' => $model,
        ),false,true);
    }

    public function actionShowTeacher($id)
    {
        $teacher = Teacher::model()->findByPk($id);
        $this->renderPartial('showTeacher',array(
            'teacher' => $teacher
        ),false,true);
    }

    public function actionCreate()
    {
        $model = new Teacher;

        if (isset($_POST['Teacher'])) {
            $model->attributes = $_POST['Teacher'];
            if ($model->save()) {
                $this->redirect($this->pathToCabinet());
            } else {
                throw new \application\components\Exceptions\IntItaException(400, 'Не вдалося додати викладача.');
            }
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ),false,true);
    }

    public function actionRoles()
    {
        $dataProvider = new CActiveDataProvider('Roles');
        $this->renderPartial('roles', array(
            'dataProvider' => $dataProvider,
        ),false,true);
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
        ),false);
    }

    public function actionCreateRole()
    {
        $model = new Roles;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'roles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);
        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];
            if ($model->save())
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/teachers/index'));
        }
        $this->renderPartial('createRole', array(
            'model' => $model,
        ),false,true);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

         $this->performAjaxValidation($model);

        if (isset($_POST['Teacher'])) {
            $model->attributes = $_POST['Teacher'];
            if ($model->save())
            $this->redirect($this->pathToCabinet());
        }
        $this->renderPartial('update', array(
            'model' => $model,
        ),false);
    }

    public function actionUpdateRole($id)
    {
        $model = Roles::model()->findByPk($id);
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'roles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];
            if ($model->save())
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/teachers/index'));
        }
        $this->renderPartial('updateRole', array(
            'model' => $model,
        ),false,true);
    }

    public function actionViewRole($id)
    {
        $model = Roles::model()->findByPk($id);

        $this->render('viewRole', array(
            'model' => $model,
        ),false);
    }

    public function loadModel($id)
    {
        $model = Teacher::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDelete($id)
    {
        $model = Teacher::model()->findByPk($id);
        $model->setDeleted();
        if(!$model->isActive()) echo 'success';
        else echo "error";
    }

    public function actionRestore($id)
    {
        $model = Teacher::model()->findByPk($id);
        $model->setActive();
        if($model->isActive()) echo 'success';
        else echo "error";
    }

    public function actionShowRoles($id)
    {
        $roles = TeacherRoles::model()->findAllByAttributes(array('teacher' => $id));
        $name = Teacher::getFullName($id);
        $this->renderPartial('showRoles', array(
            'roles' => $roles,
            'name' => $name,
            'teacherId' => $id,
        ),false,true);
    }

    public function actionAddRoleAttribute($role)
    {
        $model = new RoleAttribute;

        $this->performAttributeRoleAjaxValidation($model);

        if (isset($_POST['RoleAttribute'])) {
            $model->attributes = $_POST['RoleAttribute'];
            if ($model->save())
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/teachers/index'));
        }
        $model->role = $role;
        $this->renderPartial('addRoleAttribute', array(
            'model' => $model,
        ),false,true);
    }

    public function actionAddTeacherRole($teacher)
    {
        $model = Teacher::model()->findByPk($teacher);
        $roles = Roles::generateRolesList();

        $this->renderPartial('addTeacherRole', array(
            'teacher' => $model,
            'roles' => $roles,
        ),false,true);
    }

    public function actionCancelTeacherRole($id)
    {
        $teacher = Teacher::model()->findByPk($id);
        $roles = Teacher::generateTeacherRolesList($teacher->teacher_id);

        $this->renderPartial('cancelTeacherRole', array(
            'teacher' => $teacher,
            'roles' => $roles,
        ),false,true);
    }

    public function actionAddTeacherRoleAttribute($teacher)
    {
        $model = Teacher::model()->findByPk(intval($teacher));
        $roles = Roles::generateRolesList();
        $this->renderPartial('addTeacherRoleAttribute', array(
            'model' => $model,
            'roles' => $roles,
        ),false,true);
    }

    public function actionUpdateRoleAttribute($id){
        $model=RoleAttribute::model()->findByPk($id);

        $this->performAttributeRoleAjaxValidation($model);

        if(isset($_POST['RoleAttribute']))
        {
            $model->attributes=$_POST['RoleAttribute'];
            if($model->save())
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/teachers/index'));
        }

        $this->renderPartial('updateRoleAttribute',array(
            'model'=>$model,
        ),false,true);
    }

    public function actionGetTeachersAdminList()
    {
        echo Teacher::teachersAdminList();
    }

    public function actionUsersByQuery($query)
    {
        if ($query) {
            $users = StudentReg::usersWithoutTeachers($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
}