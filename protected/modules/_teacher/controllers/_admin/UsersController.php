<?php

class UsersController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $countAdmins = UserAdmin::model()->count();
        $countAccountants = UserAccountant::model()->count();
        $countTeachers = Teacher::model()->count();
        $countUsers = StudentReg::model()->count();
        $countStudents = UserStudent::model()->count();

        $this->renderPartial('index', array(
            'countAdmins' => $countAdmins,
            'countAccountants' => $countAccountants,
            'countTeachers' => $countTeachers,
            'countUsers' => $countUsers,
            'countStudents' => $countStudents
        ), false, true);
    }

    public function actionRenderAdminForm()
    {
        $this->renderPartial('_addAdmin', array(), false, true);
    }

    public function actionRenderAccountantForm()
    {
        $this->renderPartial('_addAccountant', array(), false, true);
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

    public function actionCancelAdmin()
    {
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        echo $model->cancelAdmin();
    }

    public function actionCancelAccountant()
    {
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        echo $model->cancelAccountant();
    }

    public function actionUsersWithoutAdmins($query)
    {
        if ($query) {
            $users = StudentReg::usersWithoutAdmins($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionUsersWithoutAccountants($query)
    {
        if ($query) {
            $users = StudentReg::usersWithoutAccountants($query);
            echo $users;
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

    public function actionGetTeachersList()
    {
        echo Teacher::teachersList();
    }

    public function actionGetAdminsList()
    {
        echo StudentReg::adminsData();
    }

    public function actionGetAccountantsList()
    {
        echo StudentReg::accountantsData();
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

        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }

    public function actionChangeTrainer($id, $oldTrainerId)
    {
        $trainerStudent = TrainerStudent::model()->findByAttributes(array('student' => $id, 'trainer' => $oldTrainerId));

        if (!$trainerStudent)
            throw new CHttpException(404, 'Вказана сторінка не знайдена');

        $user = StudentReg::model()->findByPk($id);
        $oldTrainer = RegisteredUser::userById($oldTrainerId)->getTeacher();

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
        $oldTrainerId = Yii::app()->request->getPost('oldTrainerId');
        $trainerId = Yii::app()->request->getPost('trainerId');

        $trainer = RegisteredUser::userById($trainerId);
        $oldTrainer = RegisteredUser::userById($oldTrainerId);

        $oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId);
        if ($trainer->setRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }

    public function actionRemoveTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $oldTrainerId = Yii::app()->request->getPost('oldTrainerId');

        $oldTrainer = RegisteredUser::userById($oldTrainerId);

        if($oldTrainer->unsetRoleAttribute(UserRoles::TRAINER, 'students-list', $userId)) echo "success";
        else echo "error";
    }
}