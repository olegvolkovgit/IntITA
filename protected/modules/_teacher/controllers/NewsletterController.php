<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:41
 */

class NewsletterController extends TeacherCabinetController
{

    public function hasRole(){
        return (Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager());
    }

    public function actionIndex()
    {
        $this->renderPartial('index');
    }

    public function actionGetRoles(){
        $roles = AllRolesDataSource::roles();
        $result = [];
        foreach ($roles as $role)
        {
            array_push($result,['id' =>$role, 'name'=>Role::getInstance($role)->title()]);
        }
        echo json_encode($result);
    }

    public function actionSendLetter(){
        $type = Yii::app()->request->getPost('type');
        $recipients = Yii::app()->request->getPost('recipients');
        $subject = Yii::app()->request->getPost('subject');
        $message = Yii::app()->request->getPost('message');
        $newsLetter = new NewsLetter($type,$recipients,$subject,$message);
        $newsLetter->startSend();
    }
}