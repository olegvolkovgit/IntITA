<?php

class MessagesController extends TeacherCabinetController{

    public function actionIndex()
    {
        $model = StudentReg::model()->findByPk(2);
        $message = new UserMessages();

        $sentMessages = $model->sentMessages();
        $receivedMessages = $model->receivedMessages();

       $this->renderPartial('index', array(
           'model' => $model,
           'message' => $message,
           'sentMessages' => $sentMessages,
           'receivedMessages' => $receivedMessages
       ));
    }

    public function actionWrite(){
        $this->renderPartial('_newMessage', array(
            'user' => Yii::app()->user->getId()
        ), false, true);
    }
}