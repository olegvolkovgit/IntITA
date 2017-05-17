<?php

class ExternalPaymentsController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedAuditorActions = ['getNgTable'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorActions));
    }

    public function actionGetTypeahead($query) {
        $payments = new Payments();
        echo json_encode($payments->getTypeahead($query));
    }

    public function actionCreatePayment() {
        $params = array_filter($_POST);

        $payment = new ExternalPays();
        $payment->setAttributes($params);
        //        todo validation
        if(date("Y-m-d", strtotime($payment->documentDate))!="1970-01-01"){
            $payment->documentDate=date("Y-m-d", strtotime($payment->documentDate));
        }
        $payment->createUser = Yii::app()->user->getId();
        $payment->userId = Yii::app()->user->getId();

        if ($payment->save()) {
            echo json_encode(ActiveRecordToJSON::toAssocArray($payment));
        } else {
            echo json_encode(['status' => 'error', 'message' => array_values($payment->getErrors())]);
        }
    }

    public function actionGetPayment($id) {
        $model = ExternalPays::model()->with(ExternalPays::model()->relations())->findByPk($id);
        $result=ActiveRecordToJSON::toAssocArray($model);
        $result['remainder']=$model->getRemainderSum();
        echo json_encode($result);
    }

    public function actionGetNgTable() {
        $requestParams = $_GET;
        $organization = Yii::app()->user->model->getCurrentOrganization();
        $ngTable = new NgTableAdapter(ExternalPays::model()->belongsToOrganization($organization), $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

}