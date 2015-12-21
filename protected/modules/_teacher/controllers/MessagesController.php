<?php

class MessagesController extends TeacherCabinetController{

    public function actionIndex()
    {
        $model = StudentReg::model()->findByPk(2);
        $message = new Letters();

        $sentMessages = $model->sentMessages();
        $receivedMessages = $model->receivedMessages();

       $this->renderPartial('index', array(
           'model' => $model,
           'message' => $message,
           'sentMessages' => $sentMessages,
           'receivedMessages' => $receivedMessages
       ));
    }

    public function actionWrite(){
        $this->renderPartial('_newMessage', array(), false, true);
    }

    public function actionReceivers(){
//        $users = Yii::app()->db->createCommand()->
//            ('user')
//            ->where('email', 'LIKE', '%' . $_POST['email'] . '%')
//            ->find_all()
//            ->as_array('id', 'name');
        $users = array(
            "options" => array(
                "Option 1",
                "Option 2",
                "Option 3",
                "Option 4",
                "Option 5"
            )
        );
        echo json_encode($users);
    }
}