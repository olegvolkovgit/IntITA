<?php

class MessagesController extends TeacherCabinetController
{

    public function actionIndex($alerts = [])
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
            'receivedMessages' => $receivedMessages,
            'alerts' => $alerts,
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

        $this->renderPartial('_dialogTree', array(
            'dialog' => $dialog,
            'receiver' => $receiver
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
        $jsonObj = json_decode($_POST['data']);

        $message = UserMessages::model()->findByPk($jsonObj->message);
        $receiver = StudentReg::model()->findByPk($jsonObj->receiver);
        return $message->deleteDialog($receiver);
    }

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
            case 'reply':
            case 'replyAll':
                $parentMessage = Yii::app()->request->getPost('parent', 0);
                $receiver = Messages::model()->findByPk($parentMessage)->sender0;
                $message->build($subject, $text, $receiver, $user);
                break;
            case 'forward':
                $message->build($subject, $text, $message->message0->sender0, $user);
                break;
            default:
                throw new CHttpException(400, "Unknown message type");
        }

        $message->create();
        $sender = new MailTransport();

        $alerts = [];
        if ($message->send($sender)){
            //array_push($alerts, array('type' => 'success', 'text' => 'Ваше повідомлення успішно відправлене.'));
            $this->redirect(Yii::app()->request->urlReferrer);
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
}