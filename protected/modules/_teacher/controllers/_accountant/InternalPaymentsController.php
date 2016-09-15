<?php

class InternalPaymentsController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetNgTable() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter(InternalPays::model(), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

}