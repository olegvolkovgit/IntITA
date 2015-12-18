<?php

class MessagesController extends TeacherCabinetController{

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = StudentReg::model()->findByPk(2);
        $message = new Letters();

        $sentLettersProvider = $model->getSentLettersData();
        $receivedLettersProvider = $model->getReceivedLettersData();

       $this->renderPartial('index', array(
           'model' => $model,
           'message' => $message,
           'sentLettersProvider' => $sentLettersProvider,
           'receivedLettersProvider' => $receivedLettersProvider
       ));
    }

    public function actionSend($id){
        $user = StudentReg::model()->findByPk($id);
        $topic = Yii::app()->request->getPost('topic', '');
        $body = Yii::app()->request->getPost('body', '');

        $user->generateMessage(array('topic'=> $topic, 'body' => $body));
    }
}