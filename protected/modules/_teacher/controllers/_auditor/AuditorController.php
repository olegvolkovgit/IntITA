<?php

class AuditorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAuditor();
    }

    public function actionIndex()
    {
        $this->renderPartial('/_auditor/_dashboard', array(), false, true);
    }
}