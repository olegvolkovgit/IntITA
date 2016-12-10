<?php

class UsersController extends TeacherCabinetController
{
    public function hasRole()
    {
        $allowedActions = ['getTeacherConsultantsList', 'setTeacherRoleAttribute'];
        $allowedSupervisorActions=['addTrainer','setTrainer','removeTrainer'];
        $action = Yii::app()->controller->action->id;
        if (Yii::app()->user->model->isAdmin() || 
            (Yii::app()->user->model->isContentManager() && in_array($action, $allowedActions)) ||
            (Yii::app()->user->model->isSuperVisor() && in_array($action, $allowedSupervisorActions))
        ) {
            return true;
        } else
            return false;
    }

    public function actionIndex()
    {
        $counters = [];

        $counters["admins"] = UserAdmin::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["accountants"] = UserAccountant::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["teachers"] = Teacher::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE);
        $counters["authors"] = UserAuthor::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["students"] = UserStudent::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["offlineStudents"] = OfflineStudents::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["users"] = StudentReg::model()->count('cancelled='.StudentReg::ACTIVE);
        $counters["tenants"] = UserTenant::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["trainers"] = UserTrainer::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["contentManagers"] = UserContentManager::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["teacherConsultants"] = UserTeacherConsultant::model()->with('idUser')->count("idUser.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");
        $counters["withoutRoles"] = StudentReg::countUsersWithoutRoles();
        $counters["blockedUsers"] = StudentReg::model()->count('cancelled='.StudentReg::DELETED);
        $counters["superVisors"] = UserSuperVisor::model()->with('user')->count("user.cancelled=".StudentReg::ACTIVE." AND end_date IS NULL");

        $this->renderPartial('index', array(
            'counters' => $counters
        ), false, true);
    }

    public function actionRenderAddRoleForm($role)
    {
        if($role == ""){
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильна роль.');
        }

        $title=mb_strtolower(Role::getInstance($role)->title());
        $this->renderPartial('addForms/_addRole', array('role'=>$role,'title'=>$title), false, true);
    }

    public function actionAssignRole($userId, $role){
        $result=array();
        $user = RegisteredUser::userById($userId);
        $roleObj = Role::getInstance($role);

        if ($user->hasRole($role)) {
            $result['data']="Користувач ".$user->registrationData->userNameWithEmail()." уже має цю роль";
        }else{
            if($role != UserRoles::STUDENT){
                if(!$user->isTeacher()){
                    $result['data']="Користувач не є співробітником, призначити йому вибрану роль неможливо.";
                    echo json_encode($result); return;
                }
            }
            if ($user->setRole($role))
                $result['data']="Користувачу ".$user->registrationData->userNameWithEmail()." призначена обрана роль ".$roleObj->title();
            else $result['data']="Користувачу ".$user->registrationData->userNameWithEmail()." не вдалося призначити роль ".$roleObj->title().".
    Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
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

    public function actionCancelRole($userId, $role)
    {
        $result=array();
        
        $model = RegisteredUser::userById($userId);
        $response=$model->cancelRoleMessage(new UserRoles($role));
        if($response===true){
            $result['data']="success";
        } else {
            $result['data']=$response;
        }

        echo json_encode($result);
    }

    public function actionUsersAddForm($role, $query)
    {
        $roleModel = Role::getInstance(new UserRoles($role));
        if ($query && $roleModel) {
            echo $roleModel->addRoleFormList($query);
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionGetStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams,array(
            'country0'=>true,
            'city0'=>true,
            'payModules'=>true,
            'payCourses'=>true,
            'studentTrainer'=>true));

        $criteria =  new CDbCriteria();

        $criteria->alias = 't';
        $criteria->join = 'inner join user_student us on t.id = us.id_user';
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE.' and us.end_date IS NULL';
        $criteria->group = 't.id';
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $startDate=$_GET['startDate'];
            $endDate=$_GET['endDate'];
            $criteria->condition = "TIMESTAMP(us.start_date) BETWEEN " . "'$startDate'" . " AND " . "'$endDate'";
        }

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetOfflineStudentsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineStudents', $requestParams);

        if(isset($requestParams['idGroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->join .= ' LEFT JOIN offline_groups g ON sg.group = g.id';
            $criteria->condition = 'g.id='.$requestParams['idGroup'].' and t.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }
        if(isset($requestParams['idSubgroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->condition = 'sg.id='.$requestParams['idSubgroup'].' and t.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }
        if(!isset($requestParams['idGroup']) && !isset($requestParams['idSubgroup'])){
            $criteria =  new CDbCriteria();
            $criteria->join = ' LEFT JOIN offline_subgroups sg ON t.id_subgroup = sg.id';
            $criteria->condition = 't.end_date IS NULL';
            $ngTable->mergeCriteriaWith($criteria);
        }

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetUsersList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams);

        $criteria =  new CDbCriteria();
        $criteria->condition = 't.cancelled='.StudentReg::ACTIVE;
        $ngTable->mergeCriteriaWith($criteria);

        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetWithoutRolesUsersList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('StudentReg', $requestParams,array(
            'country0'=>true,
            'city0'=>true
        ));
        
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->join = 'left join user_student us on us.id_user=t.id';
        $criteria->join .= ' left join teacher tt on tt.user_id=t.id';
        $criteria->addCondition('t.cancelled='.StudentReg::ACTIVE);
        $criteria->addCondition('us.id_user IS NULL and tt.user_id IS NULL');
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }


    public function actionGetTenantsList()
    {

        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserTenant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetContentManagersList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserContentManager', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTeacherConsultantsList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $ngTable = new NgTableAdapter('UserTeacherConsultant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTeachersList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->join = 'left join user u on u.id=t.user_id';
        $criteria->addCondition('u.cancelled='.StudentReg::ACTIVE);
        $ngTable = new NgTableAdapter('Teacher', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetAdminsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAdmin', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetAccountantsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserAccountant', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTrainersList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserTrainer', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetBlockedUsersList()
    {
        $requestParams = $_GET;
        $criteria = new CDbCriteria();
        $criteria->addCondition('unlocked_by IS NULL and unlocked_date IS NULL');
        $ngTable = new NgTableAdapter('UserBlocked', $requestParams);
        $ngTable->mergeCriteriaWith($criteria);
        echo json_encode($ngTable->getData());
    }
    
    public function actionGetSuperVisorsList()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('end_date IS NULL');
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserSuperVisor', $requestParams);

        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if (!$user)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $this->renderPartial('addForms/addTrainer', array(), false, true);
    }
   
    public function actionSetTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);
        
        $cancelResult='';
        $oldTrainerId = TrainerStudent::getTrainerByStudent($userId);
        if($oldTrainerId) {
            $oldTrainer = RegisteredUser::userById($oldTrainerId->id);
            $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
            $cancelResult="Попереднього тренера скасовано.";
        }

        $result=$trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
        if ($result===true){
            $setResult="Нового тренера призначено.";
        } else{
            $setResult=$result;
        }
        echo $cancelResult.' '.$setResult;
    }

    public function actionRemoveTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');

        $trainer = TrainerStudent::getTrainerByStudent($userId);
        $oldTrainer = RegisteredUser::userById($trainer->id);

        if($oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }
}