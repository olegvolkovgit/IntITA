<?php

class MessagesFactory
{
    public static function getInstance(Messages $model){
        switch($model->type) {
            case MessagesType::USER:
                return UserMessages::model()->findByPk($model->id);
            case MessagesType::PAYMENT:
                return MessagesPayment::model()->findByPk($model->id);
            case MessagesType::APPROVE_REVISION:
                return MessagesApproveRevision::model()->findByPk($model->id);
            case MessagesType::REJECT_REVISION:
                return MessagesRejectRevision::model()->findByPk($model->id);
            case MessagesType::REJECT_MODULE_REVISION:
                return MessagesRejectModuleRevision::model()->findByPk($model->id);
            case MessagesType::NOTIFICATION:
                return MessagesNotifications::model()->findByPk($model->id);
            case MessagesType::SERVICE_SCHEMES_REQUEST:
                return MessagesServiceSchemesRequest::model()->findByPk($model->id);
        }
        return null;
    }
}