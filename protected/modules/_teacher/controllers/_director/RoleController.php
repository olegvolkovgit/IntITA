<?php

class RoleController extends TeacherCabinetController
{
    public function hasRole()
    {
        return Yii::app()->user->model->isDirector();
    }

    public function actionRenderAddRoleForm($role)
    {
        if($role == ""){
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильна роль.');
        }

        $title=mb_strtolower(Role::getGlobalInstance($role)->title());
        $this->renderPartial('/_director/_addRole', array('role'=>$role,'title'=>$title), false, true);
    }

    public function actionRenderAddAdminForm()
    {
        $title=mb_strtolower(Role::getInstance('admin')->title());
        $this->renderPartial('/_director/_addAdmin', array('role'=>'admin','title'=>$title), false, true);
    }

    public function actionAssignRole($userId, $role, $organizationId=null){
        $result=array();
        $user = RegisteredUser::userById($userId);
        $roleObj = Role::getInstance($role);
        if ($user->hasRole($role, $organizationId)) {
            $result['data']="Користувач ".$user->registrationData->userNameWithEmail()." уже має цю роль";
        }else{
            if ($user->setRole($role, $organizationId))
                $result['data']="Користувачу ".$user->registrationData->userNameWithEmail()." призначена обрана роль ".$roleObj->title();
            else $result['data']="Користувачу ".$user->registrationData->userNameWithEmail()." не вдалося призначити роль ".$roleObj->title().". 
            Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
        }

        echo json_encode($result);
    }

    public function actionCancelRole($userId, $role, $organizationId=null)
    {
        $result=array();

        $model = RegisteredUser::userById($userId);
        $organization= $organizationId?$organizationId:null;
        $response=$model->cancelRoleMessage(new UserRoles($role), $organization);
        if($response===true){
            $result['data']="success";
        } else {
            $result['data']=$response;
        }

        echo json_encode($result);
    }
    
    public function actionAddAdmin()
    {
        $userId = Yii::app()->request->getPost('userId');
        $user = RegisteredUser::userById($userId);

        if ($user->setRole(new UserRoles("admin"))) echo "Користувач ".$user->registrationData->userNameWithEmail()." призначений адміністратором.";
        else echo "Користувача ".$user->registrationData->userNameWithEmail()." не вдалося призначити адміністратором.
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
    }

    public function actionCreateAccountant()
    {
        $userId = Yii::app()->request->getPost('userId');
        $user = RegisteredUser::userById($userId);

        if ($user->setRole(new UserRoles("accountant"))) echo "Користувач ".$user->registrationData->userNameWithEmail()." призначений бухгалтером.";
        else echo "Користувача ".$user->registrationData->userNameWithEmail()." не вдалося призначити бухгалтером.
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
    }
}