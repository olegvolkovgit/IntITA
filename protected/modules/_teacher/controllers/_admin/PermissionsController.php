<?php

class PermissionsController extends TeacherCabinetController
{
    public function hasRole()
    {
        return Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionShowTeacherModules()
    {
        $id = Yii::app()->request->getPost('teacher', '0');

        if ($id == 0)
            throw new \application\components\Exceptions\IntItaException(400, "Неправильно вибраний викладач.");
        $user = RegisteredUser::userById($id);

        $modules = $user->getAttributesByRole(UserRoles::AUTHOR)["module"];

        echo $this->renderPartial('_modules', array('modules' => $modules));
    }

    public function actionShowConsultantModules()
    {
        $id = Yii::app()->request->getPost('teacher', '0');

        if ($id == 0)
            throw new \application\components\Exceptions\IntItaException(400, "Неправильно вибраний викладач.");
        $user = RegisteredUser::userById($id);

        $modules = $user->getAttributesByRole(UserRoles::CONSULTANT)["module"];

        echo $this->renderPartial('_modules', array('modules' => $modules));
    }

    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('user', '0');
        $module = Yii::app()->request->getPost('module', '0');

        $user = RegisteredUser::userById($teacher);
        if ($user->unsetRoleAttribute(UserRoles::AUTHOR, 'module', $module)) {
            $permission = new PayModules();
            $permission->unsetModulePermission($teacher, $module, array('read', 'edit'));
            echo "success";
        } else {
            echo "error";
        }
    }

    public function actionCancelConsultantPermission()
    {
        $teacher = Yii::app()->request->getPost('user', '0');
        $module = Yii::app()->request->getPost('module', '0');

        $user = RegisteredUser::userById($teacher);
        if ($user->unsetRoleAttribute(UserRoles::CONSULTANT, 'module', $module)) {
            echo "success";
        } else {
            echo "error";
        }

    }

    public function actionModulesByQuery($query)
    {
        if ($query) {
            $modules = Module::allModules($query);
            echo $modules;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
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

    public function actionAddConsultantsByQuery($query)
    {
        echo Consultant::addConsultantsByQuery($query);
    }

    public function actionTeacherConsultantsByQuery($query)
    {
        echo TeacherConsultant::teacherConsultantsByQuery($query);
    }


    public function actionUnsetTeacherRoleAttribute()
    {
        $request = Yii::app()->request;
        $userId = $request->getPost('user', 0);
        $role = $request->getPost('role', '');
        $attribute = $request->getPost('attribute', '');
        $value = $request->getPost('attributeValue', 0);

        $user = RegisteredUser::userById($userId);

        if ($userId && $attribute && $value && $role) {
            $model = new Consultant();
            if($user->unsetRoleAttribute(new UserRoles($role), $attribute, $value)){
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
}