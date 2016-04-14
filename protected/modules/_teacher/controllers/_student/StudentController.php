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

    public function actionConsultations()
    {
        $this->renderPartial('/_student/_consultations', array(), false, true);
    }
    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if($model->deleteConsultation($user))
            echo 'success';
    }

    public function actionGetConsultationsList(){
        echo Consultationscalendar::studentConsultationsList(Yii::app()->user->getId());
    }
}