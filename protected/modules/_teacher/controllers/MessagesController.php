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
        $deletedMessages = $model->deletedMessages();

        $this->renderPartial('index', array(
            'model' => $model,
            'message' => $message,
            'sentMessages' => $sentMessages,
            'receivedMessages' => $receivedMessages,
            'deletedMessages' => $deletedMessages,
        ));
    }

    public function actionWrite($id)
    {
        $this->renderPartial('_newMessage', array(
            'user' => $id
        ), false, true);
    }

    public function actionDialog($user1, $user2)
    {
        $user1 = StudentReg::model()->findByPk($user1);
        $user2 = StudentReg::model()->findByPk($user2);
        $dialog = new Dialog($user1, $user2);
        $dialog->read();

        $this->renderPartial('_dialogTree', array(
            'dialog' => $dialog,
        ), false, true);
    }

    public function actionForm()
    {
        $jsonObj = json_decode($_POST["form"]);

        $this->renderPartial('_form' . $jsonObj->scenario, array(
            'user' => $jsonObj->user,
            'receiver' => $jsonObj->receiver,
            'message' => $jsonObj->message
        ));
    }

    public function actionDelete()
    {
        $jsonObj = json_decode($_POST['data']);

        $message = UserMessages::model()->findByPk($jsonObj->message);
        $receiver = StudentReg::model()->findByPk($jsonObj->receiver);
        return $message->deleteMessage($receiver);
    }

    public function actionDeleteDialog()
    {
        $jsonObj = json_decode($_POST['data']);

        $partner1 = StudentReg::model()->findByPk($jsonObj->partner1);
        $partner2 = StudentReg::model()->findByPk($jsonObj->partner2);
        $dialog = new Dialog($partner1, $partner2);
        $dialog->deleteDialog();
    }

    public function actionSendUserMessage()
    {
        $id = Yii::app()->request->getPost('id', 0);
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');

        $user = StudentReg::model()->findByPk($id);

        $message = new UserMessages();
        $receiverString = Yii::app()->request->getPost('receiver', '');
        $receiver = $message->parseReceiverEmail($receiverString);
        $message->build($subject, $text, array($receiver), $user);

        $message->create();
        $sender = new MailTransport();

        if ($message->send($sender)) {
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            echo 'error';
        }
    }

    public function actionUsersByQuery($query, $id)
    {
        if ($query) {
            $users = StudentReg::allUsers($query, $id);
            echo $users;
        } else {
            throw new \application\components\Exceptions\IntItaException('400');
        }
    }
}