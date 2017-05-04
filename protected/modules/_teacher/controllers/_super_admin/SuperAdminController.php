<?php

class SuperAdminController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isSuperAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('/_super_admin/_dashboard', array(), false, true);
    }
}