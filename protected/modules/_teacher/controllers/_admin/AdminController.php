<?php

class AdminController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('/_admin/index', array(), false, true);
    }
}