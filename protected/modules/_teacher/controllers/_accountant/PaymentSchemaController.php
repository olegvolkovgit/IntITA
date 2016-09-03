<?php

class PaymentSchemaController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    public function actionGetSchemas()
    {
        echo json_encode(AccountancyHelper::toAssocArray(PaymentScheme::model()->findAll()));
    }
}