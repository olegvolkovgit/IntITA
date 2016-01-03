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

    public function actionDialog($id, $user)
    {
        $message = UserMessages::model()->findByAttributes(array('id_message' => $id));

        $receiver = StudentReg::model()->findByPk($user);
        $dialog = $message->dialog($receiver);

        if (!$message->isRead($receiver)) {
            $message->read($receiver);
        }

        $this->renderPartial('_dialogTree', array(
            'dialog' => $dialog,
            'user' => $user
        ), false, true);
    }

    public function actionForm(){
        $jsonObj = json_decode($_POST['form']);

        $this->renderPartial('_form', array(
            'user' => $jsonObj->user,
            'scenario' => $jsonObj->scenario,
            'receiver' => $jsonObj->receiver,
            'message' => $jsonObj->message
        ));
    }

    public function actionReply(){

    }

    public function actionReplyAll(){

    }

    public function actionForward(){

    }

    public function actionDelete(){
        $jsonObj = json_decode($_POST['data']);

        $message = UserMessages::model()->findByPk($jsonObj->message);
        $receiver = StudentReg::model()->findByPk($jsonObj->receiver);
        return $message->deleteMessage($receiver);
    }

    public function actionDeleteAll(){

    }
}