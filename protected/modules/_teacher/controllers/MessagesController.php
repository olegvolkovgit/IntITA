<?php

class MessagesController extends TeacherCabinetController
{

    public function actionIndex()
    {
        $id = Yii::app()->user->getId();
        $model = StudentReg::model()->findByPk($id);
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

    public function actionWrite($id)
    {
        $this->renderPartial('_newMessage', array(
            'user' => $id
        ), false, true);
    }

    public function actionDialog($id)
    {
        $message = UserMessages::model()->findByAttributes(array('id_message' => $id));


        $this->renderPartial('_dialogTree', array(
            'message' => $message
        ), false, true);
    }

    public function actionReply(){

    }

    public function actionReplyAll(){

    }

    public function actionForward(){

    }

    public function actionDelete(){

    }

    public function actionDeleteAll(){

    }
}