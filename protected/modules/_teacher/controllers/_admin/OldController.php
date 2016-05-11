<?php

class OldController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $model = new PayModules('search');
        $model->unsetAttributes();
        if (isset($_GET['PayModules']))
            $model->attributes = $_GET['PayModules'];

        $this->renderPartial('index', array(
            'model' => $model,
        ), false, true);
    }

    public function actionUserStatus()
    {
        $model = new StudentReg('search');
        $model->unsetAttributes();

        if (isset($_GET['StudentReg']))
            $model->attributes = $_GET['StudentReg'];

        $this->renderPartial('userStatus', array(
            'model' => $model,
        ), false, true);
    }

    public function actionSetUserVerification($id)
    {
        StudentReg::model()->updateByPk($id, array('status' => 1));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUnsetUserVerification($id)
    {
        StudentReg::model()->updateByPk($id, array('status' => 0));

        // if AJAX request, we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }


    public static function checkPermission($idUser, $idResource, $rights)
    {
        $record = PayModules::model()->findByAttributes(array('id_user' => $idUser,
            'id_module' => $idResource));
        if (is_null($record)) {
            return false;
        } else {
            $mask = PayModules::model()->setFlags($rights);
            if ($record->rights & $mask) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function actionEdit()
    {
        $this->renderPartial('edit');
    }

    public function actionNewPermission()
    {
        $rights = Yii::app()->request->getPost('rights');
        $module = Yii::app()->request->getPost('module');
        $user = Yii::app()->request->getPost('user');


        if (!empty($module)) {
            if (PayModules::model()->exists('id_user=:user and id_module=:resource',
                array(':user' => $user, ':resource' => $module))
            ) {
                PayModules::model()->updateByPk(array('id_user' => $user,
                    'id_module' => $module), array('rights' => PayModules::setFlags($rights)));
            } else {
                Yii::app()->db->createCommand()->insert('pay_modules', array(
                    'id_user' => $user,
                    'id_module' => $module,
                    'rights' => PayModules::setFlags($rights),
                ));
            }
        }
        $this->redirect('../index');
    }

    public function actionDelete($id, $resource)
    {
        Yii::app()->db->createCommand()->delete('pay_modules', 'id_user=:id_user AND id_module=:id_resource', array(':id_user' => $id, ':id_resource' => $resource));
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionShowAddAccessForm()
    {
        $users = StudentReg::generateUsersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('_add', array(
            'users' => $users,
            'courses' => $courses
        ), false, true);
    }

    public function actionShowModules()
    {
        if (isset($_POST['course']))
            $course = $_POST['course'];

        $modules = Module::showModule($course);

        echo $this->renderPartial('_modulesList', array(
            'modules' => $modules
        ));
    }
}