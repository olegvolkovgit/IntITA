<?php

class MessagesController extends TeacherCabinetController
{
    public function hasRole(){
        return !Yii::app()->user->isGuest;
    }

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

    public function actionWrite($id, $receiver = 0)
    {
        if($receiver != 0) {
            $scenario = 'mailTo';
            $receiverModel = StudentReg::model()->findByPk($receiver);
        } else {
            $scenario = '';
            $receiverModel = null;
        }

        $this->renderPartial('_newMessage', array(
            'user' => $id,
            'receiver' => $receiverModel,
            'scenario' => $scenario,
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
            'message' => $jsonObj->message,
            'subject' => $jsonObj->subject
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
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');
        $user = Yii::app()->user->model->registrationData;

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $message = new UserMessages();
            $receiverId = Yii::app()->request->getPost('receiver', '0');
            if ($receiverId == 0) {
                throw new \application\components\Exceptions\IntItaException(400, 'Неправильно вибраний адресат повідомлення.');
            }
            $receiver = StudentReg::model()->findByPk($receiverId);
            $message->build($subject, $text, array($receiver), $user);
            $message->create();
            $sender = new MailTransport();

            $sender->renderBodyTemplate('_newMessage', array($user));
            $message->send($sender);
            $transaction->commit();
        } catch (Exception $e){
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
        echo "success";
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

    public function actionMessage($id)
    {
        $message = UserMessages::model()->findByAttributes(array('id_message' => $id));
        $this->renderPartial('_viewMessage', array(
            'message' => $message,
        ), false, true);
    }

    public function actionReply()
    {
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');
        $parentId = Yii::app()->request->getPost('parent', 0);
        $receiverId = Yii::app()->request->getPost('receiver', 0);

        $user = Yii::app()->user->model->registrationData;

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $message = new UserMessages();
            $receiver = StudentReg::model()->findByPk($receiverId);
            $message->build($subject, $text, array($receiver), $user);
            $message->parent = $parentId;
            $message->create();

            $sender = new MailTransport();
            $message->reply($receiver);
            $message->send($sender);
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
        echo "success";
    }

    public function actionForward()
    {
        $parentId = Yii::app()->request->getPost('parent', 0);
        $forwardToId = Yii::app()->request->getPost('forwardToId', 0);
        $subject = Yii::app()->request->getPost('subject', '');
        $text = Yii::app()->request->getPost('text', '');

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $sender = Yii::app()->user->model->registrationData;
            $message = UserMessages::model()->findByPk($parentId);
            $receiver = StudentReg::model()->findByPk($forwardToId);
            $message->newSubject = $subject;
            $message->newText = $text;
            $message->newSender = $sender;
            $forwardedMessage = $message->forward($receiver);

            $sender = new MailTransport();
            $forwardedMessage->send($sender);
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося переслати.");
        }
        echo "success";
    }
}