<?php

class AdminController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex($id=0) {
        $this->renderPartial('/_admin/_dashboard', array(), false, true);
    }
}