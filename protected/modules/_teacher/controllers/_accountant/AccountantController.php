<?php

class AccountantController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex($id=0)
    {
        $this->renderPartial('/_accountant/_dashboard', array(), false, true);
    }
}