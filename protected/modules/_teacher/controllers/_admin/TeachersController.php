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

    public function actionIndex()
    {
        $model = new Teacher('search');
        $model->unsetAttributes();

        if (isset($_GET['Teacher']))
            $model->attributes = $_GET['Teacher'];

        $this->render('index', array(
            'model' => $model,
        ),false,true);
    }

    public function actionShowTeacher($id)
    {
        $teacher = Teacher::model()->findByPk($id);

        $this->renderPartial('showTeacher',array(
            'teacher' => $teacher
        ));
    }

    public function actionCreate()
    {
        $model = new Teacher;
//         Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
//        var_dump($_POST);die;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Teacher'])) {
            $fileInfo = new SplFileInfo($_FILES['Teacher']['name']['foto_url']);
            if(!empty($_FILES['Teacher']['name']['foto_url'])){
                $_POST['Teacher']['foto_url'] = date('YmdHis').'.'.$fileInfo->getExtension();
            }
            $model->attributes = $_POST['Teacher'];
            $model->avatar = $_FILES['Teacher'];
            if ($model->save()) {
                if (!empty($_POST['Teacher']['foto_url'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/teachers/" . $_POST['Teacher']['foto_url'],
                        Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_" . $model->teacher_id . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
                StudentReg::model()->updateByPk($_POST['Teacher']['user_id'], array('role' => 1));
                $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/index', array('id' => Yii::app()->user->id)));
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
        ));
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
            $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/index', array('id' => Yii::app()->user->id)));
        }
        $this->renderPartial('createRole', array(
            'model' => $model,
        ),false,true);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);
        if (isset($_POST['Teacher'])) {
            $model->oldAvatar = $model->foto_url;
            $fileInfo = new SplFileInfo($_FILES['Teacher']['name']['foto_url']);
            if(!empty($_FILES['Teacher']['name']['foto_url'])){
                $_POST['Teacher']['foto_url'] = date('YmdHis').'.'.$fileInfo->getExtension();
            }
            $model->attributes = $_POST['Teacher'];
            $model->avatar = $_FILES['Teacher'];
            if ($model->save())
                if (!empty($_POST['Teacher']['foto_url'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/teachers/" . $_POST['Teacher']['foto_url'],
                        Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_" . $model->teacher_id . '.' . $fileInfo->getExtension(),
                        210
                    );
                }
            $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/index', array('id' => Yii::app()->user->id)));
//            $this->redirect(array('view', 'id' => $model->teacher_id));
        }
        $this->render('update', array(
            'model' => $model,
        ),false,true);
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
                $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/index', array('id' => Yii::app()->user->id)));
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
        ),false,true);
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

     /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        Teacher::model()->updateByPk($id, array('isPrint' => 0));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
        if (isset($_POST['RoleAttribute'])) {
            $model->attributes = $_POST['RoleAttribute'];
            if ($model->save())
                $this->redirect(array('showAttributes', 'role' => $model->role));
        }
        $model->role = $role;
        $this->renderPartial('addRoleAttribute', array(
            'model' => $model,
        ),false,true);
    }

    public function actionAddTeacherRole($teacher)
    {
        $model = Teacher::model()->findByPk($teacher);

        $this->renderPartial('addTeacherRole', array(
            'teacher' => $model,
        ),false,true);
    }

    public function actionCancelTeacherRole()
    {
        $teacher = Teacher::model()->findByPk($_GET['id']);

        $this->renderPartial('cancelTeacherRole', array(
            'teacher' => $teacher,
        ),false,true);
    }

    public function actionAddTeacherRoleAttribute($teacher)
    {
        $model = Teacher::model()->findByPk(intval($teacher));

        $this->renderPartial('addTeacherRoleAttribute', array(
            'model' => $model,
        ),false,true);
    }


    public function actionUpdateRoleAttribute($id){
        $model=RoleAttribute::model()->findByPk($id);

        if(isset($_POST['RoleAttribute']))
        {
            $model->attributes=$_POST['RoleAttribute'];
            if($model->save())
                $this->redirect($this->pathToCabinet());
        }

        $this->renderPartial('updateRoleAttribute',array(
            'model'=>$model,
        ),false,true);
    }

}