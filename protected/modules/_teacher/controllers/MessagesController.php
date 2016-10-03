<?php

class MessagesController extends TeacherCabinetController
{
    public function hasRole(){
        return !Yii::app()->user->isGuest;
    }

    public function actionGetUserSentMessages(){
        $criteria = new CDbCriteria();
        $params =$_GET;
        if (isset($params['filter']['name']))
        {
            $criteria->addSearchCondition('receiver.email',urldecode($params['filter']['name']),true,'AND');
            $criteria->addSearchCondition('receiver.firstName',urldecode($params['filter']['name']),true,'OR');
            $criteria->addSearchCondition('receiver.secondName',urldecode($params['filter']['name']),true,'OR');
            unset($params['filter']['name']);
        }
        if (isset($params['filter']['subject']))
        {
            $criteria->addSearchCondition('userMessages.subject',urldecode($params['filter']['subject']),true,'AND');
            $criteria->addSearchCondition('notificationMessages.subject',urldecode($params['filter']['subject']),true,'OR');
            unset($params['filter']['subject']);
        }
        $criteria->compare('sender.id',Yii::app()->user->getId(),false,'AND');
        $criteria->addCondition('message.type =1 AND deleted IS NULL');
        $criteria->with = ['message','sender','userMessages','paymentMessage','approveRevisionMessages','rejectRevisionMessages','notificationMessages','rejectModuleRevisionMessages','payCourse','payModule'];
        $adapter = new NgTableAdapter('MessageReceiver',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo  json_encode($adapter->getData());
    }

    public function actionGetUserReceiverMessages(){
        $params = $_GET;
        $criteria = new CDbCriteria();

        if (isset($params['filter']['name']))
        {
            $criteria->addSearchCondition('sender.email',urldecode($params['filter']['name']),true,'AND');
            $criteria->addSearchCondition('sender.firstName',urldecode($params['filter']['name']),true,'OR');
            $criteria->addSearchCondition('sender.secondName',urldecode($params['filter']['name']),true,'OR');
            unset($params['filter']['name']);
        }
        if (isset($params['filter']['subject']))
        {
            $criteria->addSearchCondition('userMessages.subject',urldecode($params['filter']['subject']),true,'AND');
            $criteria->addSearchCondition('notificationMessages.subject',urldecode($params['filter']['subject']),true,'OR');
            unset($params['filter']['subject']);
        }
        $criteria->compare('id_receiver',Yii::app()->user->getId(),false,'AND');
        $criteria->addInCondition('message.type',[1,2,6,7,9,12],'AND');
        $criteria->addCondition('deleted IS NULL');
        $criteria->with = ['message','sender','userMessages','paymentMessage','approveRevisionMessages','rejectRevisionMessages','notificationMessages','rejectModuleRevisionMessages','payCourse','payModule'];
        $adapter = new NgTableAdapter('MessageReceiver',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo  json_encode($adapter->getData());
    }

    public function actionGetUserDeletedMessages(){
        $params =$_GET;
        $criteria = new CDbCriteria();
        if (isset($params['filter']['name']))
        {
            $criteria->addSearchCondition('sender.email',urldecode($params['filter']['name']),true,'AND');
            $criteria->addSearchCondition('sender.firstName',urldecode($params['filter']['name']),true,'OR');
            $criteria->addSearchCondition('sender.secondName',urldecode($params['filter']['name']),true,'OR');
            unset($params['filter']['name']);
        }
        if (isset($params['filter']['subject']))
        {
            $criteria->addSearchCondition('userMessages.subject',urldecode($params['filter']['subject']),true,'AND');
            $criteria->addSearchCondition('notificationMessages.subject',urldecode($params['filter']['subject']),true,'OR');
            unset($params['filter']['subject']);
        }
        $criteria->compare('id_receiver',Yii::app()->user->getId(),false,'AND');
        $criteria->addInCondition('message.type',[1,2,6,7,9,12],'AND');
        $criteria->addCondition('deleted IS NOT NULL');
        $criteria->with = ['message','sender','userMessages','paymentMessage','approveRevisionMessages','rejectRevisionMessages','notificationMessages','rejectModuleRevisionMessages','payCourse','payModule'];
        $adapter = new NgTableAdapter('MessageReceiver',$params);
        $adapter->mergeCriteriaWith($criteria);
        echo  json_encode($adapter->getData());
    }

    public function actionIndex()
    {
//        $id = Yii::app()->user->getId();
//        $model = StudentReg::model()->findByPk($id);
//        $message = new UserMessages();
//        $sentMessages = $model->sentMessages();
//        $receivedMessages = $model->receivedMessages();
//        $deletedMessages = $model->deletedMessages();
//
//        $this->renderPartial('index', array(
//            'model' => $model,
//            'message' => $message,
//            'sentMessages' => $sentMessages,
//            'receivedMessages' => $receivedMessages,
//            'deletedMessages' => $deletedMessages,
//        ));

       $this->renderPartial('indexNg');

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
        if (isset($jsonObj->messages)) {
            foreach ($jsonObj->messages as $item) {

                    $message = MessagesFactory::getInstance(Messages::model()->findByPk($item));
                    $message->deleteMessage(StudentReg::model()->findByPk(Yii::app()->user->id));

            }
            echo 'success';
        }
        else {
            $message = MessagesFactory::getInstance(Messages::model()->findByPk($jsonObj->message));
            $receiver = StudentReg::model()->findByPk($jsonObj->receiver);
            if ($message->deleteMessage($receiver))
                echo 'success';
            else
                echo 'error';
        }
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
        $message = MessagesFactory::getInstance(Messages::model()->findByPk($id));
        //$message = UserMessages::model()->findByAttributes(array('id_message' => $id));
        $deleted = $message->isDeleted(StudentReg::model()->findByPk(Yii::app()->user->id));
        if (!$message->isRead(StudentReg::model()->findByPk(Yii::app()->user->id)))
            $message->read(StudentReg::model()->findByPk(Yii::app()->user->id));

        $this->renderPartial('_viewMessage', array(
            'message' => $message, 'deleted'=>$deleted
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
            $sender->renderBodyTemplate('_newMessage', array($user));
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

        $user = Yii::app()->user->model->registrationData;
        
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
            $sender->renderBodyTemplate('_newMessage', array($user));
            $forwardedMessage->send($sender);
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося переслати.");
        }
        echo "success";
    }
}