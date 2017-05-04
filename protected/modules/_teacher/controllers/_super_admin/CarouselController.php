<?php

class CarouselController extends TeacherCabinetController
{
    private $callerName = 'carousel';

    public function hasRole(){
        return Yii::app()->user->model->isSuperAdmin();
    }
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->renderPartial('view',array(
			'model'=>$this->loadModel($id),
		),false,true);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Carousel;
		// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
		if(isset($_POST['Carousel'])) {

            $picName = $_FILES['Carousel']['name'];
            $tmpName = $_FILES['Carousel']['tmp_name'];

            $model->attributes = $_POST['Carousel'];

            $info = new SplFileInfo($picName['pictureURL']);
            $extension = $info->getExtension();
            $filename = uniqid() . '.' . $extension;

            $model->pictureURL = $filename;

            if ($model->validate()) {
                Avatar::saveMainSliderPicture($model, $tmpName, $filename);

                $model->save();
                $this->redirect('/cabinet/#/carousel');
            }
        }

		$this->renderPartial('create',array(
			'model'=>$model,
		),false,true);
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
        $this->performAjaxValidation($model);

		if(isset($_POST['Carousel']))
		{
            $oldSlide=$model->pictureURL;

            $picName = $_FILES['Carousel']['name'];
            $tmpName = $_FILES['Carousel']['tmp_name'];

			$model->attributes=$_POST['Carousel'];

            if(!empty($picName['pictureURL'])) {
                $info = new SplFileInfo($picName['pictureURL']);
                $extension = $info->getExtension();
                $filename = uniqid() . '.' . $extension;
                $model->pictureURL = $filename;
            }else{
                $model->pictureURL=$oldSlide;
            }
            $filename=$model->pictureURL;
            if($model->validate()) {
                Avatar::saveMainSliderPicture($model, $tmpName, $filename, $oldSlide);

                if ($model->update())
                    $this->redirect('/cabinet/#/carousel');
            }
		}

		$this->renderPartial('update',array(
			'model'=>$model,
		),false,true);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $model->delete();
        Slider::sortOrder($model);

        $this->actionIndex();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->renderPartial('index',array(),false,true);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Carousel the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Carousel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Carousel $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='carousel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUp($order)
    {
        if($order == 1)
            return $this->actionIndex();

        $model = Carousel::model()->findByAttributes(array('order' => $order));
        $prevModel = Carousel::model()->findByAttributes(array('order' => $order-1));
        $model->setScenario('swapImage');

        if($prevModel){
            $model->setScenario('swapImage');
            $prevModel->setScenario('swapImage');
            Carousel::swapImage($model,$prevModel);

            if($model->validate() && $prevModel->validate())
            {
                $model->save();
                $prevModel->save();
            }

        }
    }

    public function actionDown($order)
    {
        $model = Carousel::model()->findByAttributes(array('order' => $order));

        if($order == $model->getLastOrder())
            $this->redirect(Yii::app()->createUrl('/_teacher/_super_admin/carousel/index'));
        else {
            $nextModel = $this->getNextModel($order);
            if($nextModel){
                $model->setScenario('swapImage');
                $nextModel->setScenario('swapImage');

                Carousel::swapImage($model,$nextModel);

                if($model->validate() && $nextModel->validate())
                {
                    $model->save();
                    $nextModel->save();

                }
            }
        }
    }
    public function actionTextUp($order)
    {
        if($order == 1)
            return $this->actionIndex();

        $model = Carousel::model()->findByAttributes(array('order' => $order));
        $prevModel = Carousel::model()->findByAttributes(array('order' => $order-1));
        $model->setScenario('swapImage');

        if($prevModel){
            $model->setScenario('swapImage');
            $prevModel->setScenario('swapImage');
            Carousel::swapText($model,$prevModel);

            if($model->validate() && $prevModel->validate())
            {
                $model->save();
                $prevModel->save();
            }

        }
    }

    public function actionTextDown($order)
    {
        $model = Carousel::model()->findByAttributes(array('order' => $order));

        if($order == $model->getLastOrder())
            $this->redirect(Yii::app()->createUrl('/_teacher/_super_admin/carousel/index'));
        else {
            $nextModel = $this->getNextModel($order);
            if($nextModel){
                $model->setScenario('swapImage');
                $nextModel->setScenario('swapImage');

                Carousel::swapText($model,$nextModel);

                if($model->validate() && $nextModel->validate())
                {
                    $model->save();
                    $nextModel->save();

                }
            }
        }
    }

    public function getNextModel($order)
    {
        $nextModel = null;
        $order++;
        $exists = Carousel::model()->exists('`order` = :order',array(':order'=> $order));
        if($exists)
        {
            $nextModel = Carousel::model()->findByAttributes(array('order' => $order));
            return $nextModel;
        }
        else return $this->getNextModel($order);
    }

    public function actionGetItemsList(){
        echo Carousel::getItemsList();
    }

}
