<?php

class StudentController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isStudent();
    }

    public function actionIndex($id)
    {
        $student = RegisteredUser::userById($id);

        $this->renderPartial('/_student/index', array(
            'student' => $student
        ), false, true);
    }
}