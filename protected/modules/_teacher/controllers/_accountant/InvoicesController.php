<?php

class InvoicesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $invoices = Invoice::model()->findAll();

        $this->renderPartial('index',array(
            'invoices'=>$invoices,
        ), false, true);
    }

    public function actionGetInvoices() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('Invoice', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionGetTypeahead($query) {
        $invoices = new Invoices();
        $models = $invoices->getTypeahead($query);
        echo json_encode($models);
    }

    public function actionAgreementList(){
        $model= new Invoice('search');
        $model->unsetAttributes();
        if(isset($_GET['Invoice']))
            $model->attributes=$_GET['Invoice'];

        $this->renderPartial('index',array(
            'model'=>$model,
        ), false, true);
    }

    public function actionInvoicesList($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'agreement_id = ' . $id;

        $invoices = Invoice::model()->findAll($criteria);
        $this->renderPartial('invoicesList',array(
            'invoices'=>$invoices,
        ), false, true);
    }
}