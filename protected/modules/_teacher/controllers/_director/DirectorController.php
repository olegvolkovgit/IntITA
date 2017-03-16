<?php

class DirectorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isDirector();
    }

    public function actionIndex()
    {
        $this->renderPartial('/_director/_dashboard', array(), false, true);
    }
}