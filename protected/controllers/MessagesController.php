<?php

class MessagesController extends Controller {

    public function actionSendUserMessage(){
        $id = Yii::app()->request->getPost('user', '');
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');
        $receivers = Yii::app()->request->getPost('receivers', []);
        $user = StudentReg::model()->findByPk($id);

        $message = new UserMessages();
        $message->build($subject, $text, $receivers, $user);
        $message->create();

        $sender = new MailTransport();
        if ($message->send($sender)){
            echo 'success';
        } else {
            echo 'error';
        }
    }
}