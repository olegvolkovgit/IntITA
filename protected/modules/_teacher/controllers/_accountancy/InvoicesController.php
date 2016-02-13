<?php

class InvoicesController extends TeacherCabinetController
{
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $invoices = Invoice::model()->findAll();

        $this->render('index',array(
            'invoices'=>$invoices,
        ));
    }

    public function actionAgreementList(){
        $model= new Invoice('search');
        $model->unsetAttributes();
        if(isset($_GET['Invoice']))
            $model->attributes=$_GET['Invoice'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    public function actionInvoicesList($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'agreement_id = ' . $id;

        $invoices = Invoice::model()->findAll($criteria);
        $this->render('invoicesList',array(
            'invoices'=>$invoices,
        ));
    }
}