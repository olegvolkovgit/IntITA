<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.11.2015
 * Time: 17:09
 */

class InvoicesController extends AccountancyController
{
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Invoice('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Invoice']))
            $model->attributes=$_GET['Invoice'];

        $this->render('index',array(
            'model'=>$model,
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
        $model = UserAgreements::getInvoicesList($id);

        $this->render('invoicesList',array(
            'dataProvider'=>$model,
        ));
    }
}