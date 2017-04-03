<?php

class InternalPaymentsController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetNgTable() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(InternalPays::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

}