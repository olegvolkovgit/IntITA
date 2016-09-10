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

        $params = json_decode(Yii::app()->request->rawBody, true);

        $payment = new ExternalPays();
        $payment->setAttributes($params);
        $payment->createUser = Yii::app()->user->getId();
        $payment->userId = Yii::app()->user->getId();

        if ($payment->save()) {
            echo json_encode(AccountancyHelper::toAssocArray($payment));
        } else {
            echo json_encode(array_merge($payment->getErrors(), ['status' => 'error']));
        }
    }

    public function actionGetPayment($id) {
        $model = ExternalPays::model()->with(ExternalPays::model()->relations())->findByPk($id);
        echo json_encode(AccountancyHelper::toAssocArray($model));
    }

}