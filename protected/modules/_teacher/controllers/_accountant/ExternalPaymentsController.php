<?php

class ExternalPaymentsController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetTypeahead($query) {
        $payments = new Payments();
        echo json_encode($payments->getTypeahead($query));
    }

    public function actionCreatePayment() {
        $payment = new ExternalPays();
        foreach ($payment->getAttributes() as $attribute=>$value) {
            $payment->setAttribute($attribute, Yii::app()->request->getParam($attribute, null));
        }

        $payment->createUser = Yii::app()->user->getId();
        $payment->userId = Yii::app()->user->getId();

        if ($payment->save()) {
            echo json_encode(AccountancyHelper::toAssocArray($payment));
        } else {
            echo json_encode(array_merge($payment->getErrors(), ['status' => 'error']));
        }
    }

}