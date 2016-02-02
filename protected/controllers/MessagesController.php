<?php

class MessagesController extends Controller {

    public function actionSendUserMessage(){
        $scenario = Yii::app()->request->getPost('scenario', '');
        $id = Yii::app()->request->getPost('id', 0);
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');

        $user = StudentReg::model()->findByPk($id);

        $message = new UserMessages();
        switch($scenario){
            case 'new':
                $receiverString = Yii::app()->request->getPost('receiver', '');
                $receiver = $message->parseReceiverEmail($receiverString);
                $message->build($subject, $text, $receiver, $user);
                break;
            default:
                throw new \application\components\Exceptions\IntItaException(400, "Лист не вдалося надіслати.");
        }

        $message->create();
        $sender = new MailTransport();


        if ($message->send($sender)){
            echo '1';
        } else {
            echo 'error';
        }
    }

    public function actionReply(){
        $id = Yii::app()->request->getPost('id', 0);
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');
        $parentId = Yii::app()->request->getPost('parent', 0);
        $receiverId = Yii::app()->request->getPost('receiver', 0);

        $user = StudentReg::model()->findByPk($id);
        $message = new UserMessages();

        $receiver = StudentReg::model()->findByPk($receiverId);
        $message->build($subject, $text, $receiver, $user);

        $message->create();
        $sender = new MailTransport();

        if ($message->send($sender)){
            $message->parent = $parentId;
            $message->reply($receiver);
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            echo 'error';
        }
    }

    public function actionForward(){
        $parentId = Yii::app()->request->getPost('parent', 0);
        $forwardTo = Yii::app()->request->getPost('forwardTo', 0);

        $message = UserMessages::model()->findByPk($parentId);
        $receiver = $message->parseReceiverEmail($forwardTo);
        $message->forward($receiver);

        $sender = new MailTransport();
        if ($message->send($sender)){
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            echo 'error';
        }
    }
}