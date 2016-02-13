<?php

class AgreementsController extends TeacherCabinetController
{
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new UserAgreements;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserAgreements'])) {
            $model->attributes = $_POST['UserAgreements'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserAgreements'])) {
            $model->attributes = $_POST['UserAgreements'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->renderPartial('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
                return "success";
            else return "fail";
        } else {
            throw new CHttpException(403, "Договір ще не підтверджений. Ви не можете його закрити.");
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