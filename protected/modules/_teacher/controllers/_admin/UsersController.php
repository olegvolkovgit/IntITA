<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.01.2016
 * Time: 13:31
 */

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


}