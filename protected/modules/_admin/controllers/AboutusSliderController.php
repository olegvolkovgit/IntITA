<?php

class AboutusSliderController extends AdminController
{
	/**
	 * @return array action filters
	 */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
//	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}

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
		$model=new AboutusSlider;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AboutusSlider']))
		{

            $picName = $_FILES['AboutusSlider']['name'];
            $tmpName = $_FILES['AboutusSlider']['tmp_name'];

			$model->attributes=$_POST['AboutusSlider'];
            $model->pictureUrl = $picName['pictureUrl'];
            if($model->validate()){
            Avatar::saveAbuotusSlider($model,$picName,$tmpName);

			if($model->save())
				$this->redirect(array('view','id'=>$model->image_order));
            }
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

		if(isset($_POST['AboutusSlider']))
		{
			$model->attributes=$_POST['AboutusSlider'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->image_order));
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
        $type = 'AboutUs';
		$this->loadModel($id)->delete();

        Slider::sortOrder($type);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new AboutusSlider('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['AboutusSlider']))
            $model->attributes=$_GET['AboutusSlider'];

        $dataProvider=new CActiveDataProvider('AboutusSlider');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AboutusSlider('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AboutusSlider']))
			$model->attributes=$_GET['AboutusSlider'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AboutusSlider the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AboutusSlider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AboutusSlider $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='aboutus-slider-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUp($order)
    {
        if($order == 1)
            $this->actionIndex();

        $model = AboutusSlider::model()->findByAttributes(array('order' => $order));
        $prevModel = AboutusSlider::model()->findByAttributes(array('order' => $order-1));

        if($prevModel){

            $model->setScenario('swapImage');
            $prevModel->setScenario('swapImage');

            AboutusSlider::swapImage($model,$prevModel);

            if($model->validate() && $prevModel->validate())
            {
                $model->save();
                $prevModel->save();
            }

            $this->actionIndex();
        }
        else return;
    }

    public function actionDown($order)
    {

        $model = AboutusSlider::model()->findByAttributes(array('order' => $order));
        if($order == $model->getLastAboutusOrder())
            $this->actionIndex();

        else{
            $nextModel = AboutusSlider::model()->findByAttributes(array('order' => $order + 1));

            if($nextModel){

                $model->setScenario('swapImage');
                $nextModel->setScenario('swapImage');

                AboutusSlider::swapImage($model,$nextModel);

                if($model->validate() && $nextModel->validate())
                {
                    $model->save();
                    $nextModel->save();
                }

                $this->actionIndex();
            }
        }
    }

}
