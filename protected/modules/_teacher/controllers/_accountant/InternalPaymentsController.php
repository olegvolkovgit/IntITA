<?php

class InternalPaymentsController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedAuditorActions = ['getNgTable'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorActions));
    }

    public function actionGetNgTable() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(InternalPays::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

}