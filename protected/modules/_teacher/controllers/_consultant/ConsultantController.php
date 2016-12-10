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
}