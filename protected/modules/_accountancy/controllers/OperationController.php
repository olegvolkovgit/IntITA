<?php

class OperationController extends AccountancyController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($model)
	{
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//$model = Operation::createOperation();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

//		if(isset($_POST['Operation']))
//		{
//			$model->attributes=$_POST['Operation'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}

        $agreements = UserAgreements::getAllAgreements();
        $invoices = Invoice::getAllInvoices();

		$this->render('create',array(
			//'model'=>$model,
            'agreementsList'=>$agreements,
            'invoicesList'=>$invoices,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operation']))
		{
			$model->attributes=$_POST['Operation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Operation('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Operation']))
			$model->attributes=$_GET['Operation'];

		$this->render('index',array(
			'model'=>$model,
		));
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
		$model=Operation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Operation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='operation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionGetSearchAgreements(){

        $agreement = Yii::app()->request->getPost('agreement',0);

        $result = UserAgreements::findLikeAgreement($agreement);

        return $this->renderPartial('_ajaxAgreement',array('agreements' => $result));

    }

    public function actionGetInvoicesList()
    {
        $id =  Yii::app()->request->getPost('id');

        $result = UserAgreements::getInvoices($id);

        return $this->renderPartial('_ajaxInvoices',array('invoices' => $result));
    }

    public function actionCreateByInvoice(){
        $request = Yii::app()->request;

        $invoice = $request->getPost('invoices', "");
        $summa = $request->getPost('summa', 0);
        $user = $request->getPost('user', 0);
        $type = $request->getPost('type', 0);
        $source = $request->getPost('source', 0);

        //var_dump($invoice);die;
        if (Operation::addOperation($summa, $user, $type, $invoice, $source)) {
            $this->actionIndex();
        } else {
            throw new CException('Operation is not saved!');
        }
    }

    public function actionGetInvoicesByNumber()
    {
        $invoiceNumber = Yii::app()->request->getPost('invoiceNumber', 0);

        $result = Invoice::findLikeInvoices($invoiceNumber);

        return $this->renderPartial('_ajaxInvoices',array('invoices' => $result));
    }

    public function actionGetUser()
    {
        $userEmail = Yii::app()->request->getPost('userEmail', 0);
        $userList = StudentReg::findLikeEmail($userEmail);
        $user = [];
        if($userList){
        foreach($userList as $users)
        {
            $userAgr = UserAgreements::model()->findByAttributes(array('user_id' => $users->id));
            if($userAgr)
            {
                array_push($user,$userAgr);
            }
        }
        }

        return $this->renderPartial('_ajaxUser',array('users' => $user));
    }
    public function actionGetAgreementsByUser()
    {
        $userId = Yii::app()->request->getPost('userId');

        $result = UserAgreements::findAgreementByUser($userId);

        return $this->renderPartial('_ajaxAgreement',array('agreements' => $result));
    }
}
