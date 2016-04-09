<?php

class RequestController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('index',array(),false,true);
    }

    public function actionRequest($message)
    {
        $model = MessagesAuthorRequest::model()->findByPk($message);
        if(!$model){
            $model = MessagesTeacherConsultantRequest::model()->findByPk($message);
        }
        if($model) {
            $this->renderPartial('request', array(
                'model' => $model
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionGetRequestList(){
        echo MessagesAuthorRequest::listAllRequests();
    }

    public function actionApprove($message, $user){
        $model = MessagesAuthorRequest::model()->findByPk($message);
        if(!$model){
            $model = MessagesTeacherConsultantRequest::model()->findByPk($message);
        }
        $userModel = StudentReg::model()->findByPk($user);
        if($model && $userModel){
            if($model->approve($userModel)){
                echo "success";
            }else{
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function actionCancel($message, $user){
        $model = MessagesAuthorRequest::model()->findByPk($message);
        if(!$model){
            $model = MessagesTeacherConsultantRequest::model()->findByPk($message);
        }
        if($model){
            if($model->setDeleted($user)){
                echo "success";
            }else{
                echo "error";
            }
        } else {
            echo "error";
        }
    }
}