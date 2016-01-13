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
        $this->redirect('index');
    }

    public function actionAddAccountant(){
        $this->redirect('index');
    }
}