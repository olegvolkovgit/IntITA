<?php

class RequestController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $this->renderPartial('index',array(),false,true);
    }

    public function actionRequest($message, $module)
    {
        $model = MessagesAuthorRequest::model()->findByPk(array($message, $module));
        $this->renderPartial('request',array(
            'model' => $model
        ),false,true);
    }

    public function actionGetRequestList(){
        echo MessagesAuthorRequest::listAllRequests();
    }

    public function actionApprove($message, $module, $user){
        $model = MessagesAuthorRequest::model()->findByPk(array($message, $module));
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

    public function actionCancel($message, $module, $user){
        $model = MessagesAuthorRequest::model()->findByPk(array($message, $module));
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