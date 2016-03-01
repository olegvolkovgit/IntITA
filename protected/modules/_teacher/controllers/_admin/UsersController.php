<?php

class UsersController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $adminsList = StudentReg::adminsList();
        $accountants = StudentReg::accountantsList();
        $teachers = StudentReg::teachersList();
        $users = StudentReg::model()->findAll();

        $this->renderPartial('index', array(
            'adminsList' => $adminsList,
            'accountants' => $accountants,
            'teachers' => $teachers,
            'users' => $users,
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
        $user = Yii::app()->request->getPost('user', '');
        $email = explode(" ", $user);
        $email = $email[count($email) - 1];
        $model = StudentReg::model()->findByAttributes(array('email' => $email));
        echo $model->addAdmin();
    }

    public function actionCreateAccountant()
    {
        $user = Yii::app()->request->getPost('user', '');
        $email = explode(" ", $user);
        $email = $email[count($email) - 1];
        $model = StudentReg::model()->findByAttributes(array('email' => $email));
        echo $model->addAccountant();
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

        if ($trainer->setRoleAttribute(new UserRoles('trainer'), 'students-list', $userId)) echo "success";
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

        $oldTrainer->unsetRoleAttribute(new UserRoles('trainer'), 'students-list', $userId);
        if ($trainer->setRoleAttribute(new UserRoles('trainer'), 'students-list', $userId)) echo "success";
        else echo "error";
    }

    public function actionRemoveTrainer()
    {
        $userId = Yii::app()->request->getPost('userId');
        $oldTrainerId = Yii::app()->request->getPost('oldTrainerId');

        $oldTrainer = RegisteredUser::userById($oldTrainerId);

        if($oldTrainer->unsetRoleAttribute(new UserRoles('trainer'), 'students-list', $userId)) echo "success";
        else echo "error";
    }
}