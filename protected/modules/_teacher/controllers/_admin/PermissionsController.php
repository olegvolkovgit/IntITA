<?php

class PermissionsController extends TeacherCabinetController
{
    public $menu = array();

    public function init()
    {
        parent::init();
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
    }

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
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['StudentReg']))
            $model->attributes = $_GET['StudentReg'];

        $this->renderPartial('userStatus', array(
            'model' => $model,
        ), false, true);
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
        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/permissions/index'));
    }

    public function actionDelete($id, $resource)
    {
        Yii::app()->db->createCommand()->delete('pay_modules', 'id_user=:id_user AND id_module=:id_resource', array(':id_user' => $id, ':id_resource' => $resource));
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

//    public function actionShowModules()
//    {
//        if (isset($_POST['course']))
//            $course = $_POST['course'];
//
//        $result = Module::showModule($course);
//
//        echo $result;
//    }

    public function actionNewTeacherPermission()
    {
        $teacherId = Yii::app()->request->getPost('user');
        $teacher = Teacher::model()->findByAttributes(array('teacher_id' => $teacherId));
        $module = Yii::app()->request->getPost('module');

        if ($module) {
            Teacher::addTeacherAccess($teacher->teacher_id, $module);

            $permission = new PayModules();
            $permission->setModulePermission(
                $teacher->user_id,
                $module,
                array('read', 'edit'));
        }
        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/permissions/index'));
    }

    public function actionAddTeacher()
    {
        $user = Yii::app()->request->getPost('user');
        $user = StudentReg::model()->findByPk($user);

        if ($user->isTeacher()) {
            Yii::app()->user->setFlash('warning', "Користувач з таким email вже є викладачем.");
        }
        $user->save();

        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/roleAttribute/index'));
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

//    public function actionShowTeacherModules()
//    {
//        if (isset($_POST['teacher'])) {
//            $idTeacher = $_POST['teacher'];
//            $result = TeacherModule::showTeacherModule($idTeacher);
//        } else $result = '';
//        echo $result;
//    }


    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('teacher');
        $module = Yii::app()->request->getPost('module');

        $userId = Teacher::model()->findByAttributes(array('teacher_id' => $teacher))->user_id;

        TeacherModule::cancelTeacherAccess($teacher, $module);

        $permission = new PayModules();
        $permission->unsetModulePermission(
            $userId,
            $module,
            array('read', 'edit'));

        $this->redirect(Yii::app()->createUrl('/_teacher/_admin/permissions/index'));
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

    public function actionShowAddTeacherAccess()
    {
        $users = Teacher::generateTeachersList();
        $courses = Course::generateCoursesList();

        $this->renderPartial('_addTeacherAccess', array(
            'users' => $users,
            'courses' => $courses
        ), false, true);
    }

    public function actionShowCancelTeacherAccess()
    {
        $users = Teacher::generateTeachersList();

        $this->renderPartial('_cancelTeacherAccess', array(
            'users' => $users
        ), false, true);
    }

}