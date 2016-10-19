<?php

class PaymentSchemaController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetSchemas()
    {
        echo json_encode(ActiveRecordToJSON::toAssocArray(PaymentScheme::model()->findAll()));
    }
}