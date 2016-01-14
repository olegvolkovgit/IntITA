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
        echo "Trainer";
    }

    public function actionCreateAccountant(){
        echo 'Success!';
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
}