<?php

class AgreementsController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $agreements = UserAgreements::model()->findAll();

        $this->renderPartial('index', array(
            'agreements' => $agreements
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UserAgreements the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = UserAgreements::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UserAgreements $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-agreements-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionConfirm()
    {
        $id = Yii::app()->request->getPost('id', '0');
        if($id == 0){
            echo "fail";
            Yii::app()->end();
        }
        if (UserAgreements::model()->findByPk($id)->approval_date == null) {
            UserAgreements::model()->updateByPk($id, array(
                'approval_user' => Yii::app()->user->getId(),
                'approval_date' => date("Y-m-d H:i:s"),
            ));
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function actionCancel()
    {
        $id = Yii::app()->request->getPost('id', '0');
        if($id == 0){
            return "fail";
        }
        if (UserAgreements::model()->findByPk($id)->approval_date != null) {
            if(UserAgreements::model()->updateByPk($id, array(
                'cancel_user' => Yii::app()->user->getId(),
                'cancel_date' => date("Y-m-d H:i:s"),
            )))
                echo "Договір ".$id." скасований.";
            else echo "Договір ".$id." не вдалося скасувати. Спробуйте пізніше або зверніться до адміністратора "
            .Config::getAdminEmail();
        } else {
           echo "Договір ще не підтверджений. Ви не можете його закрити.";
        }
    }

    public function actionAgreement($id)
    {
        $model = UserAgreements::model()->findByPk($id);

        if (is_null($model)) {
            throw new CHttpException(400, "Такого договора немає.");
        }
        $this->renderPartial('agreement', array(
            'model' => $model,
        ));
    }
}