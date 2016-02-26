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

        $this->renderPartial('index', array(
            'model' => $model,
        ),false,true);
    }

    public function actionShowTeacher($id)
    {
        $user = RegisteredUser::userById($id);
        if(!$user->isTeacher()){
            throw new \application\components\Exceptions\IntItaException(400, 'Такого викладача немає.');
        }
        $teacher = $user->getTeacher();

        $this->renderPartial('showTeacher',array(
            'teacher' => $teacher,
            'user' => $user
        ),false,true);
    }

    public function actionCreate()
    {
        $model = new Teacher;

        if (isset($_POST['Teacher'])) {

            if(!empty($_FILES['Teacher']['name']['foto_url'])){
                $fileInfo = new SplFileInfo($_FILES['Teacher']['name']['foto_url']);
                $_POST['Teacher']['foto_url'] = date('YmdHis').'.'.$fileInfo->getExtension();
                $model->avatar = $_FILES['Teacher'];
            }

            $model->attributes = $_POST['Teacher'];

            if ($model->save()) {

                if (!empty($_POST['Teacher']['foto_url'])) {
                    ImageHelper::uploadAndResizeImg(
                        Yii::getPathOfAlias('webroot') . "/images/teachers/" . $_POST['Teacher']['foto_url'],
                        Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_" . $model->teacher_id .
                        '.' . $fileInfo->getExtension(),210
                    );
                }
                StudentReg::model()->updateByPk($_POST['Teacher']['user_id'], array('role' => 1));
                $this->redirect($this->pathToCabinet());
            }
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ),false,true);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

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
            $this->redirect($this->pathToCabinet());
        }
        $this->renderPartial('update', array(
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionCancelTeacherRole($id)
    {
        $user = RegisteredUser::userById($id);
        $roles = $user->getRoles();
        $teacher = $user->getTeacher();

        $this->renderPartial('cancelTeacherRole', array(
            'teacher' => $teacher,
            'roles' => $roles,
        ),false,true);
    }

    public function actionAddTeacherRole($id)
    {
        $user = RegisteredUser::userById($id);
        $teacher = $user->getTeacher();
        $roles = UserRoles::teachersRolesList();

        $this->renderPartial('addTeacherRole', array(
            'teacher' => $teacher,
            'roles' => $roles,
        ),false,true);
    }

    //todo rewrite
    public function actionUnsetTeacherRole()
    {
        $id = Yii::app()->request->getPost('teacher');
        $role = Yii::app()->request->getPost('role');

        $user = RegisteredUser::userById($id);
        $teacher = $user->getTeacher();
        if ($id && $role) {
            if ($teacher->unsetTeacherRole(new UserRoles($role))) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }

    public function actionSetTeacherRole()
    {
        $id = Yii::app()->request->getPost('teacher', 0);
        $role = Yii::app()->request->getPost('role', '');

        $user = RegisteredUser::userById($id);
        $teacher = $user->getTeacher();
        if ($id && $role) {
            if ($teacher->setTeacherRole(new UserRoles($role))) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }


    //todo rewrite teacher roles list
    public function actionAddTeacherRoleAttribute($id)
    {
        $user = RegisteredUser::userById($id);
        $roles = $user->getRoles();
        $teacher = $user->getTeacher();

        $this->renderPartial('addTeacherRoleAttribute', array(
            'model' => $teacher,
            'roles' => $roles,
        ),false,true);
    }
}