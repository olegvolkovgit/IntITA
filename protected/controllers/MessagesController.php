<?php

class MessagesController extends Controller {

    public function actionSendUserMessage(){
        $id = Yii::app()->request->getPost('id', '');
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');
        $receiverString = Yii::app()->request->getPost('receiver', '');

        $user = StudentReg::model()->findByPk($id);

        $message = new UserMessages();
        $receiver = $message->parseReceiverEmail($receiverString);
        $message->build($subject, $text, $receiver, $user);
        $message->create();

        $sender = new MailTransport();

        if ($message->send($sender)){
            echo 'success';
        } else {
            echo 'error';
        }
    }
}