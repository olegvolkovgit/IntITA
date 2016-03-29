<?php

class PermissionsController extends TeacherCabinetController
{

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionShowTeacherModules()
    {
        $id = Yii::app()->request->getPost('teacher', '0');

        if($id == 0)
            throw new \application\components\Exceptions\IntItaException(400, "Неправильно вибраний викладач.");
        $user = RegisteredUser::userById($id);

        $modules = $user->getAttributesByRole(UserRoles::AUTHOR)["module"];

        echo $this->renderPartial('_modules', array('modules' => $modules));
    }

    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('user', '0');
        $module = Yii::app()->request->getPost('module', '0');

        $user = RegisteredUser::userById($teacher);
        if($user->unsetRoleAttribute(UserRoles::AUTHOR, 'module', $module)){
            $permission = new PayModules();
            $permission->unsetModulePermission($teacher, $module, array('read', 'edit'));
                echo "success";
        } else {
            echo "error";
        }
    }

    public function actionShowAddTeacherAccess()
    {
        $this->renderPartial('_addTeacherAccess', array(), false, true);
    }

    public function actionShowCancelTeacherAccess()
    {
        $this->renderPartial('_cancelTeacherAccess', array(), false, true);
    }

    public function actionTeachersByQuery($query)
    {
        echo Teacher::teachersByQuery($query);
    }

    public function actionConsultantsByQuery($query)
    {
        echo Consultant::consultantsByQuery($query);
    }
}