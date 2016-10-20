<?php

class PaymentSchemaController extends TeacherCabinetController
{
    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetSchemas() {
        echo json_encode(ActiveRecordToJSON::toAssocArray(PaymentScheme::model()->findAll()));
    }

    public function actionCreateSchema () {
        $result = ['message' => 'OK'];
        try {
            $params = $_POST;
            $offer = null;
            $soFactory = new SpecialOfferFactory($params);
            $offer = $soFactory->createSpecialOffer();
            if ($offer === null) {
                $offer = new PaymentScheme();
                $params['pay_count'] = key_exists('payCount', $params) ? $params['payCount'] : null;
                $offer->setAttributes($params);
                $offer->save();

                if (count($offer->getErrors())) {
                    throw new Exception(json_encode($offer->getErrors()));
                }
            }
        } catch (Exception $error) {
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        echo json_encode($result);
    }
}