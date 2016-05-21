<?php

class ConsultantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isConsultant();
    }

    public function actionModules($id)
    {
        $consultant = RegisteredUser::userById($id);
        $role = new Consultant();
        $modules = $role->activeModules($consultant->registrationData);

        $this->renderPartial('/_consultant/_modules', array(
            'modules' => $modules,
            'user' => $consultant
        ), false, true);
    }

    public function actionConsultations()
    {
        $this->renderPartial('/_consultant/_consultations', array(), false, true);
    }

    public function actionGetConsultationsList(){
        echo Consultationscalendar::consultationsList(Yii::app()->user->getId());
    }

    public function actionCancelConsultation($id)
    {
        $model = Consultationscalendar::model()->findByPk($id);
        $user = RegisteredUser::userById(Yii::app()->user->getId());
        if ($model->deleteConsultation($user))
            echo 'success';
    }
}