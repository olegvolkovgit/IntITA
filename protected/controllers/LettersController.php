<?php

class LettersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Letters;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Letters']))
		{
			$model->attributes=$_POST['Letters'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Letters']))
		{
			$model->attributes=$_POST['Letters'];
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Letters');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Letters('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Letters']))
			$model->attributes=$_GET['Letters'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Letters the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Letters::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Letters $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='letters-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionSendLetter()
    {
        $model= new UserMessages();
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-messages-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['UserMessages']))
        {
            $model->attributes=$_POST['UserMessages'];
            $model->date = date("Y-m-d H:i:s");
            if($model->validate())
            {
                $model->save();
                Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0537"));
                $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
            } else {
                Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0538"));
                $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
            }
        }
    }
    public function actionSendRespLetter($id)
    {
        $tab=3;
        $model= new Letters();
        if(isset($_POST['ajax']) && $_POST['ajax']==='respletter-form'.$id)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['Letters']))
        {
            $model->attributes=$_POST['Letters'];
            $model->date = date("Y-m-d H:i:s");
            if($model->validate())
            {
                $model->save();
                Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0537"));
                $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id, 'tab'=>$tab)));
            } else {
                Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0538"));
                $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id, 'tab'=>$tab)));
            }
        }
    }
    public function actionStatusUpdate($id)
    {
        $model=Letters::model()->findByPk($id);
        if($model->status==0){
            $model->updateByPk($id, array('status' => '1'));
        }
        Yii::app()->end();
    }
}
