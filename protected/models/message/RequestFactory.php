<?php

class RequestFactory
{
    public static function getInstance(Messages $model){
        switch($model->type){
            case MessagesType::AUTHOR_REQUEST:
                return MessagesAuthorRequest::model()->findByPk($model->id);
            case MessagesType::TEACHER_CONSULTANT_REQUEST:
                return MessagesTeacherConsultantRequest::model()->findByPk($model->id);
            case MessagesType::COWORKER_REQUEST:
                return MessagesCoworkerRequest::model()->findByPk($model->id);
            default:
                return null;
        }
    }
}