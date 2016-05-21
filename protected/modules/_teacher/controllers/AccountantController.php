<?php

class AccountantController extends TeacherCabinetController{

    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionIndex(){
        $this->renderPartial('index');
    }
}