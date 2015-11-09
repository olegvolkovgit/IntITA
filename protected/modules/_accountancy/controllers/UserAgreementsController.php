<?php

class UserAgreementsController extends CController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'admin', 'delete', 'create', 'update', 'confirm', 'cancel'),
                'expression'=>array($this, 'isAccountant'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('delete', 'create', 'update', 'view', 'index', 'admin', 'confirm', 'cancel'),
                'users'=>array('*'),
            ),
		);
	}

    //if user account has role 2 (accountant)
    function isAccountant()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 2) {

            return true;
        }
        return false;
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserAgreements;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserAgreements']))
		{
			$model->attributes=$_POST['UserAgreements'];
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

		if(isset($_POST['UserAgreements']))
		{
			$model->attributes=$_POST['UserAgreements'];
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
        $model=new UserAgreements('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['UserAgreements']))
            $model->attributes=$_GET['UserAgreements'];

        $this->render('index',array(
            'model'=>$model,
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
		$model=UserAgreements::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserAgreements $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-agreements-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionConfirm($id){
        if (UserAgreements::model()->findByPk($id)->approval_date == null) {
            UserAgreements::model()->updateByPk($id, array(
                'approval_user' => Yii::app()->user->getId(),
                'approval_date' => date("Y-m-d H:i:s"),
            ));
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionCancel($id){
        if (UserAgreements::model()->findByPk($id)->approval_date != null) {
            UserAgreements::model()->updateByPk($id, array(
                'cancel_user' => Yii::app()->user->getId(),
                'cancel_date' => date("Y-m-d H:i:s"),
            ));
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            throw new CHttpException(403, "Договір ще не підтверджений. Ви не можете його закрити.");
        }
    }

    public function actionAgreement($id){
        $model = UserAgreements::model()->findByPk($id);

        if(is_null($model)){
            throw new CHttpException(400, "Такого договора немає.");
        }
        $this->render('agreement',array(
            'model'=>$model,
        ));
    }
}
