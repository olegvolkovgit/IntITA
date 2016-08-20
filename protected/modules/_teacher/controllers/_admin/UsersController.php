<?php

class UsersController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $counters = [];

        $counters["admins"] = UserAdmin::model()->count("end_date IS NULL");
        $counters["accountants"] = UserAccountant::model()->count("end_date IS NULL");
        $counters["teachers"] = Teacher::model()->count('cancelled='.Teacher::ACTIVE);
        $counters["students"] = UserStudent::model()->count("end_date IS NULL");
        $counters["users"] = StudentReg::model()->count('cancelled='.StudentReg::ACTIVE);
        $counters["tenants"] = UserTenant::model()->count("end_date IS NULL");
        $counters["trainers"] = UserTrainer::model()->count("end_date IS NULL");
        $counters["consultants"] = UserConsultant::model()->count("end_date IS NULL");
        $counters["contentManagers"] = UserContentManager::model()->count("end_date IS NULL");
        $counters["teacherConsultants"] = UserTeacherConsultant::model()->count("end_date IS NULL");
        $counters["withoutRoles"] = StudentReg::countUsersWithoutRoles();

        $this->renderPartial('index', array(
            'counters' => $counters
        ), false, true);
    }

    public function actionRenderAddRoleForm($role)
    {
        if($role == ""){
            throw new \application\components\Exceptions\IntItaException(400, 'Неправильна роль.');
        }
        $view = "addForms/_add".ucfirst($role);
        $this->renderPartial($view, array(), false, true);
    }

    public function actionAssignRole(){
        $userId = Yii::app()->request->getPost('userId');
        $role = Yii::app()->request->getPost('role');
        $user = RegisteredUser::userById($userId);

        if ($user->hasRole($role)) {
            echo "Користувач ".$user->registrationData->userNameWithEmail()." уже має цю роль";
            return;
        }
        if ($user->setRole($role))
            echo "Користувачу ".$user->registrationData->userNameWithEmail()." призначена обрана роль ".$role;
        else echo "Користувачу ".$user->registrationData->userNameWithEmail()." не вдалося призначити роль ".$role.".
        Спробуйте повторити операцію пізніше або напишіть на адресу ".Config::getAdminEmail();
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

    public function actionCancelRole()
    {
        $user = Yii::app()->request->getPost('userId', '0');
        $role = Yii::app()->request->getPost('role', '');
        if($user && $role){
            $model = RegisteredUser::userById($user);
            echo $model->cancelRoleMessage(new UserRoles($role));
        } else {
            echo "Неправильний запит. Зверніться до адміністратора ".Config::getAdminEmail();
        }
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
        $startDate = Yii::app()->request->getParam('startDate');
        $endDate = Yii::app()->request->getParam('endDate');
        echo StudentReg::getStudentsList($startDate, $endDate);
    }

    public function actionGetUsersList()
    {
        echo StudentReg::usersList();
    }

    public function actionGetWithoutRolesUsersList()
    {
        echo StudentReg::withoutRolesUsersList();
    }


    public function actionGetTenantsList()
    {
        echo UserTenant::tenantsList();
    }

    public function actionGetContentManagersList()
    {
        echo UserContentManager::contentManagersList();
    }

    public function actionGetTeacherConsultantsList()
    {
        echo UserTeacherConsultant::teacherConsultantsList();
    }

    public function actionGetTeachersList()
    {
        echo Teacher::teachersList();
    }

    public function actionGetAdminsList()
    {
        echo UserAdmin::adminsData();
    }

    public function actionGetAccountantsList()
    {
        echo UserAccountant::accountantsData();
    }

    public function actionGetTrainersList()
    {
        echo UserTrainer::trainersList();
    }

    public function actionGetConsultantsList()
    {
        echo UserConsultant::consultantsList();
    }

    public function actionAddTrainer($id)
    {
        $user = StudentReg::model()->findByPk($id);
        if (!$user)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $trainers = Teacher::getAllTrainers();

        $this->renderPartial('addTrainer', array(
            'user' => $user,
            'trainers' => $trainers
        ), false, true);
    }

    public function actionSetTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');
        $trainer = RegisteredUser::userById($trainerId);

        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)===true) echo "success";
        else echo $trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
    }

    public function actionChangeTrainer($id)
    {
        $trainer = TrainerStudent::getTrainerByStudent($id);
        if($trainer){
            $oldTrainer = RegisteredUser::userById($trainer->id)->getTeacher();
        } else {
            $oldTrainer = null;
        }

        $user = StudentReg::model()->findByPk($id);

        $trainers = Teacher::getAllTrainers();

        $this->renderPartial('changeTrainer', array(
            'user' => $user,
            'trainers' => $trainers,
            'oldTrainer' => $oldTrainer
        ), false, true);
    }

    public function actionTrainers($query)
    {
        if ($query) {
            $users = Trainer::trainersByQuery($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionEditTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $trainerId = Yii::app()->request->getPost('trainerId');

        $trainer = RegisteredUser::userById($trainerId);
        $oldTrainerId = TrainerStudent::getTrainerByStudent($userId);
        if($oldTrainerId) {
            $oldTrainer = RegisteredUser::userById($oldTrainerId->id);
            $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
        }
        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
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