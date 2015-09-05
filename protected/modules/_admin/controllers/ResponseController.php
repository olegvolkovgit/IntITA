<?php

class ResponseController extends CController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

    public function init()
    {
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
    }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}


    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('delete', 'edit', 'index'),
                'expression'=>array($this, 'isAdministrator'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('delete', 'edit', 'index'),
                'users'=>array('*'),
            ),
        );
    }

    function isAdministrator()
    {
        if(AccessHelper::isAdmin())
            return true;
        else
            return false;
    }

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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Response']))
		{
			$model->attributes=$_POST['Response'];
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
        $model=new Response('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Response']))
            $model->attributes=$_GET['Response'];


        $dataProvider=new CActiveDataProvider('Response');
		$this->render('index',array(
            'model' => $model,
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Response the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Response::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Response $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='response-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionSetPublish($id)
    {
        Response::model()->updateByPk($id, array('is_checked' => 1));

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUnsetPublish($id)
    {
        Response::model()->updateByPk($id, array('is_checked' => 0));

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }


    public function actionUpdateResponseText($id){
        Response::model()->updateByPk($id, array(
            'text' => $_POST['Response']['text'],
            'is_checked' => $_POST['Response']['is_checked']
        ));

        $this->actionView($id);
    }
}
