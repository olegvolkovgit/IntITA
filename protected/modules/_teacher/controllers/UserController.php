<?php

class UserController extends TeacherCabinetController {

    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex($id)
    {
        $model = RegisteredUser::userById($id);
        $this->renderPartial('index', array(
            'model' => $model
        ), false, true);
    }

    public function actionUserAccess($id = 1){
        $model = RegisteredUser::userById($id);
        $this->renderPartial('_userAccess', array(
            'model' => $model
        ), false, true);
    }

    public function actionAddRole($id){
        $model = RegisteredUser::userById($id);
        $roles = AllRolesDataSource::roles();

        $this->renderPartial('addUserRole', array(
            'model' => $model,
            'roles' => $roles
        ), false, true);
    }

    //todo
    public function actionChangeAccountStatus(){

    }

    //todo
    public function actionChangeUserStatus(){

    }

    public function actionUnsetUserRole(){
        $user = Yii::app()->request->getPost('userId', '0');
        $role = Yii::app()->request->getPost('role', '');
        if($user && $role){
            $model = RegisteredUser::userById($user);
            $roleModel = Role::getInstance($role);
            if(!$roleModel->checkBeforeDeleteRole($user->registrationData)){
                echo $roleModel->getErrorMessage();
            } else {
                if ($model->cancelRole(new UserRoles($role))) {
                    echo "Обрану роль успішно скасовано.";
                } else {
                    echo "Роль не вдалося скасувати.";
                }
            }
        } else {
            echo "Неправильний запит. Зверніться до адміністратора ".Config::getAdminEmail();
        }
    }

    public function actionAgreement($user, $param, $type){
        switch($type){
            case "module":
                $model = UserAgreements::moduleAgreement($user, $param, 1, 'Online');
                break;
            case "course":
                $model = UserAgreements::courseAgreement($user, $param, 1, 'Online');
                break;
            default:
                throw new \application\components\Exceptions\IntItaException(400);
        }
        if($model){
            $this->renderPartial('/_student/_agreement', array(
                'agreement' => $model,
            ));
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    //todo
    public function actionSetUserRole()
    {
        $id = Yii::app()->request->getPost('user', 0);
        $role = Yii::app()->request->getPost('role', '');

        $user = RegisteredUser::userById($id);
        if ($id && $role) {
            if ($user->setRole(new UserRoles($role))) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            throw new \application\components\Exceptions\IntItaException(400, "Неправильний запит.");
        }
    }

    //todo
    public function actionSetStudentRoleAttribute(){
        $request = Yii::app()->request;
        $userId = $request->getPost('user', 0);
        $role = $request->getPost('role', '');
        $attribute = $request->getPost('attribute', '');
        $value = $request->getPost('attributeValue', 0);
        $user = RegisteredUser::userById($userId);

        if ($userId && $attribute && $value && $role) {
            if($user->setRoleAttribute(new UserRoles($role), $attribute, $value)){
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
}