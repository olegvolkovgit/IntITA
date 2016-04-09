<?php

/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 11.12.2015
 * Time: 15:36
 */
class TeacherController extends TeacherCabinetController
{
    public function hasRole(){
        return !Yii::app()->user->isGuest;
    }

    public function actionAssignedConsultant()
    {
        $idPlainTaskAnswer = Yii::app()->request->getPost('idPlainTask');
        $consult = Yii::app()->request->getPost('consult');
        $model = StudentReg::model()->findByPk($consult);

        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($idPlainTaskAnswer);

        $sender = new MailTransport();
        $sender->renderBodyTemplate('_assignedConsultantLetter', array($plainTaskAnswer));
        if ($sender->send($model->email, "", 'Нова задача', "")) {
            echo "success";
        } else {
            echo "error";
        }

        if (!PlainTaskAnswer::assignedConsult($idPlainTaskAnswer, $consult))
            throw new \application\components\Exceptions\IntItaException(400, 'Consult was not saved');
    }
}