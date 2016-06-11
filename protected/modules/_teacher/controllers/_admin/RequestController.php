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
        echo RequestsList::listAllActiveRequests();
    }

    public function actionGetApprovedRequestsList()
    {
        echo RequestsList::listAllApprovedRequests();
    }

    public function actionGetDeletedRequestsList()
    {
        echo RequestsList::listAllDeletedRequests();
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
                echo "Запит вже підтверджено. Ви не можете підтвердити запит двічі.";
            }
        } else {
            echo "Операцію не вдалося виконати.";
        }
    }
}