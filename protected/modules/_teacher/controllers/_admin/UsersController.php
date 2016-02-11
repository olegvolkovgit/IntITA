<?php

class UsersController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $adminsList = StudentReg::adminsList();
        $accountants = StudentReg::accountantsList();
        $teachers = StudentReg::teachersList();
        $users = StudentReg::model()->findAll();

        $this->renderPartial('index',array(
            'adminsList' => $adminsList,
            'accountants' => $accountants,
            'teachers' => $teachers,
            'users' => $users,
        ),false,true);
    }

    public function actionRenderAdminForm(){
        $this->renderPartial('_addAdmin',array(),false,true);
    }

    public function actionRenderAccountantForm(){
        $this->renderPartial('_addAccountant',array(),false,true);
    }

    public function actionAddAdmin(){
        $user = Yii::app()->request->getPost('user', '');
        $email = explode(" ", $user);
        $email = $email[count($email)-1];
        $model = StudentReg::model()->findByAttributes(array('email' => $email));
        echo $model->addAdmin();
    }

    public function actionCreateAccountant(){
        $user = Yii::app()->request->getPost('user', '');
        $email = explode(" ", $user);
        $email = $email[count($email)-1];
        $model = StudentReg::model()->findByAttributes(array('email' => $email));
        echo $model->addAccountant();
    }

    public function actionCancelAdmin(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        echo $model->cancelAdmin();
    }

    public function actionCancelAccountant(){
        $user = Yii::app()->request->getPost('user', '0');
        $model = StudentReg::model()->findByPk($user);
        echo $model->cancelAccountant();
    }

    public function actionUsersWithoutAdmins($query){
        if ($query) {
            $users = StudentReg::usersWithoutAdmins($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionUsersWithoutAccountants($query){
        if ($query) {
            $users = StudentReg::usersWithoutAccountants($query);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }

    public function actionGetStudentsList() {
        $startDate = Yii::app()->request->getParam('startDate');
        $endDate = Yii::app()->request->getParam('endDate');
        echo StudentReg::getStudentsList($startDate, $endDate);
    }
}