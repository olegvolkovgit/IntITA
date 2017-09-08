<?php


class RequestController extends TeacherCabinetController
{
    public function hasRole()
    {
        return Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionRequest($message)
    {
        $messageModel = Messages::model()->findByPk($message);
        $messageModel->accessForOrganization();
        $model = RequestFactory::getInstance($messageModel);
        if ($model) {
            $this->renderPartial('request', array(
                'model' => $model
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionGetActiveRequestsList()
    {
        $adapter = new NgTableRequestsAdapter(NgTableRequestsAdapter::NEWREQUESTS);
        echo $adapter->getData();
       // echo RequestsList::listAllActiveRequests();
    }

    public function actionGetApprovedRequestsList()
    {
        $adapter = new NgTableRequestsAdapter(NgTableRequestsAdapter::APPROWEDREQUESTS);
        echo $adapter->getData();
    }

    public function actionGetDeletedRequestsList()
    {
        $adapter = new NgTableRequestsAdapter(NgTableRequestsAdapter::DELETEDREQUESTS);
        echo $adapter->getData();
        //echo RequestsList::listAllDeletedRequests();
    }

    public function actionGetRejectedRevisionRequestsList()
    {
        $adapter = new NgTableRequestsAdapter(NgTableRequestsAdapter::REJECTEDEQUESTS);
        echo $adapter->getData();
        //echo RequestsList::listAllRejectedRevisionRequests();
    }
    
    public function actionApprove($message, $user)
    {
        $messageModel = Messages::model()->findByPk($message);
        $model = RequestFactory::getInstance($messageModel);
        $userModel = StudentReg::model()->findByPk($user);

        if ($model && $userModel) {
            if (!$model->isApproved()) {
                echo $model->approve($userModel);
            } else {
                echo "Запит вже підтверджено. Ви не можете підтвердити запит двічі.";
            }
        } else {
            echo "Операцію не вдалося виконати.";
        }
    }

    public function actionCancel($message, $user)
    {
        $messageModel = Messages::model()->findByPk($message);
        $model = RequestFactory::getInstance($messageModel);

        if ($model) {
            if (!$model->isDeleted()) {
                echo $model->setDeleted($user);
            } else {
                echo "Запит вже скасований.";
            }
        } else {
            echo "Операцію не вдалося виконати.";
        }
    }

    public function actionReject($message, $user)
    {
        $messageModel = Messages::model()->findByPk($message);
        $model = RequestFactory::getInstance($messageModel);
        $userModel = StudentReg::model()->findByPk($user);

        $comment=Yii::app()->request->getPost('comment','');
        if($messageModel->type==MessagesType::REVISION_REQUEST){
            $message = new MessagesRejectRevision();
            $message->sendRevisionRejectMessage(RevisionLecture::model()->findByPk($model->id_revision), $comment);
        }
        if($messageModel->type==MessagesType::MODULE_REVISION_REQUEST){
            $message = new MessagesRejectModuleRevision();
            $message->sendModuleRevisionRejectMessage(RevisionModule::model()->findByPk($model->id_module_revision), $comment);
        }

        if ($model && $userModel) {
            if (!$model->isRejected()) {
                echo $model->reject($userModel);
            } else {
                echo "Запит вже відхилений. Ви не можете відхилити запит двічі.";
            }
        } else {
            echo "Операцію не вдалося виконати.";
        }
    }
}