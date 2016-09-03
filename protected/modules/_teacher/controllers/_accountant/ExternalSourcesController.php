<?php

class ExternalSourcesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetSources() {
        $models = ExternalSources::model()->findAll();
        echo json_encode(AccountancyHelper::toAssocArray($models));
    }

}