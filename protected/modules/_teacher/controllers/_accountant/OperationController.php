<?php

class OperationController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedAuditorActions = ['index'];
        $action = Yii::app()->controller->action->id;
        return Yii::app()->user->model->isAccountant() ||
            (Yii::app()->user->model->isAuditor() && in_array($action, $allowedAuditorActions));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($model)
    {
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
//        $agreements = UserAgreements::getAllAgreements();
//        $invoices = Invoice::getAllInvoices();

        $this->renderPartial('create', null, false, true);
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

        if (isset($_POST['Operation'])) {
            $model->attributes = $_POST['Operation'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
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
     * Manages all models.
     * @param $organization
     */
    public function actionIndex($organization)
    {
        $this->renderPartial('index', array('organization'=>$organization));
    }

    public function actionGetOperations($page = 1, $pageCount=10) {
        $limit = $pageCount;
        $offset = $page * $pageCount - $pageCount;
        $operations = new Operations();
        echo json_encode($operations->getOperations($offset, $limit));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Operation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Operation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Operation $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'operation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetSearchAgreements()
    {
        $agreement = Yii::app()->request->getPost('agreement', 0);

        $result = UserAgreements::findLikeAgreement($agreement);

        return $this->renderPartial('_ajaxAgreement', array('agreements' => $result));

    }

    public function actionGetInvoicesList()
    {
        $id = Yii::app()->request->getPost('id');
        $result = UserAgreements::model()->findByPk($id)->getInvoices();
        return $this->renderPartial('_ajaxInvoices', array('invoices' => $result));
    }

    /*

     curl 'http://intita.project/_teacher/_accountant/operation/createByInvoice'  \
    -H 'Cookie: cookie_key=0a33cfa08c193c2db5f0bdc107038592; phpbb3_6vpfb_sid=cd24ee3f2e713ff8eaacf1b7d39d4e9f; PHPSESSID=5hfqqoc2ihoo4eavcg5ot0okv1; XDEBUG_SESSION=PHPSTORM' \
    --data 'userId=354&agreementId=32&invoiceId=321&invoices[0]=318&invoices[1]=319&invoices[2]=320&invoices[3]=321&sum=1021&sourceId=9'

     */

    public function actionCreateByInvoice()
    {
        try {
            $operationData = json_decode(Yii::app()->request->rawBody, true);
            $operations =  new Operations();
            echo json_encode($operations->performOperation($operationData, Yii::app()->user));
        } catch (Exception $exception) {
            echo json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function actionGetInvoicesByNumber()
    {
        $invoiceNumber = Yii::app()->request->getPost('invoiceNumber', 0);
        $result = Invoice::findLikeInvoices($invoiceNumber);
        return $this->renderPartial('_ajaxInvoices', array('invoices' => $result));
    }

    public function actionGetUser()
    {
        $userEmail = Yii::app()->request->getPost('userEmail', 0);
        $userList = StudentReg::findLikeEmail($userEmail);
        $agreements = [];
        if ($userList) {
            foreach ($userList as $users) {
                $userAgr = UserAgreements::model()->findByAttributes(array('user_id' => $users->id));
                if ($userAgr) {
                    array_push($agreements, $userAgr);
                }
            }
        }

        return $this->renderPartial('_ajaxUser', array('agreements' => $agreements));
    }

    public function actionGetAgreementsByUser()
    {
        $userId = Yii::app()->request->getPost('userId');

        $result = UserAgreements::findAgreementByUser($userId);

        return $this->renderPartial('_ajaxAgreement', array('agreements' => $result));
    }

    public function actionCancel()
    {
        $operations = Operation::model()->findAll();

        $this->render('cancel', array(
            'operations' => $operations
        ));
    }

    public function actionDeleteService($id)
    {
        $operation = $this->loadModel($id);
        if ($operation->cancel())
            $this->redirect(Yii::app()->request->urlReferrer);
        else throw new \application\components\Exceptions\IntItaException(500, 'Операція не була видалена');
    }
}