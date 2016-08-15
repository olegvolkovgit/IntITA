<?php

class AgreementsController extends TeacherCabinetController {
    public function hasRole() {
        return Yii::app()->user->model->isAccountant();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UserAgreements the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = UserAgreements::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UserAgreements $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-agreements-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->renderPartial('index');
    }

    public function actionGetAgreementsList($page = 0, $pageCount = 10) {
        $agreements = new Agreements();
        $limit = $pageCount;
        $offset = $page * $pageCount - $pageCount;
        $json = $agreements->getUserAgreements($offset, $limit);
        echo json_encode($json);
    }

    public function actionConfirm($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model) {
            $model->confirm(Yii::app()->user);
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }

        echo json_encode($response);
    }

    public function actionCancel($id = 0) {
        $model = UserAgreements::model()->findByPk($id);
        $response = [];
        if ($model) {
            $model->cancel(Yii::app()->user);
            $response['result'] = 'success';
        } else {
            $response['result'] = 'fail';
        }
        echo json_encode($response);
    }

    public function actionAgreement() {
        $this->renderPartial('agreement');
    }

    public function actionGetAgreement($id) {
        $agreements = new Agreements();
        $agreements->getUserAgreement($id);
        echo json_encode($agreements->getUserAgreement($id));
    }
}