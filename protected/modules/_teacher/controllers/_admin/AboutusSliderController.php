<?php

class AboutusSliderController extends TeacherCabinetController
{

	public function hasRole(){
		return Yii::app()->user->model->isAdmin();
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
		$model=new AboutusSlider;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['AboutusSlider']))
		{

            $picName = $_FILES['AboutusSlider']['name'];
            $tmpName = $_FILES['AboutusSlider']['tmp_name'];

			$model->attributes=$_POST['AboutusSlider'];

			$info = new SplFileInfo($picName['pictureUrl']);
			$extension = $info->getExtension();
			$filename = uniqid() . '.' . $extension;

            $model->pictureUrl = $filename;
            if($model->validate()){
				Avatar::saveAbuotusSlider($model, $tmpName, $filename);

			if($model->save())
                $this->redirect('/cabinet/#/admin/aboutusSlider');
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

		if(isset($_POST['AboutusSlider']))
		{
			$oldSlide=$model->pictureUrl;

			$picName = $_FILES['AboutusSlider']['name'];
			$tmpName = $_FILES['AboutusSlider']['tmp_name'];

			$model->attributes=$_POST['AboutusSlider'];

			if(!empty($picName['pictureUrl'])) {
				$info = new SplFileInfo($picName['pictureUrl']);
				$extension = $info->getExtension();
				$filename = uniqid() . '.' . $extension;
				$model->pictureUrl = $filename;
			}else{
				$model->pictureUrl=$oldSlide;
			}
			$filename=$model->pictureUrl;
			if($model->validate()) {
				Avatar::saveAbuotusSlider($model, $tmpName, $filename, $oldSlide);

				if ($model->update())
					$this->redirect('/cabinet/#/admin/aboutusSlider');
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
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
		$this->renderPartial('index',array(
			'dataProvider'=>$dataProvider,
            'model' => $model,
		),false,true);
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

		$this->renderPartial('admin',array(
			'model'=>$model,
		),false,true);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='aboutusSliderForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUp($order)
    {
        if($order == 1)
            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));

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

            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));
        }
        else return;
    }

    public function actionDown($order)
    {

        $model = AboutusSlider::model()->findByAttributes(array('order' => $order));
        if($order == $model->getLastAboutusOrder())
            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));

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

                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));
            }
        }
    }
	public function actionTextUp($order)
	{
		if($order == 1)
			$this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));

		$model = AboutusSlider::model()->findByAttributes(array('order' => $order));
		$prevModel = AboutusSlider::model()->findByAttributes(array('order' => $order-1));

		if($prevModel){

			$model->setScenario('swapImage');
			$prevModel->setScenario('swapImage');

			AboutusSlider::swapText($model,$prevModel);

			if($model->validate() && $prevModel->validate())
			{
				$model->save();
				$prevModel->save();
			}

			$this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));
		}
		else return;
	}

	public function actionTextDown($order)
	{

		$model = AboutusSlider::model()->findByAttributes(array('order' => $order));
		if($order == $model->getLastAboutusOrder())
			$this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));

		else{
			$nextModel = AboutusSlider::model()->findByAttributes(array('order' => $order + 1));

			if($nextModel){

				$model->setScenario('swapImage');
				$nextModel->setScenario('swapImage');

				AboutusSlider::swapText($model,$nextModel);

				if($model->validate() && $nextModel->validate())
				{
					$model->save();
					$nextModel->save();
				}

				$this->redirect(Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index'));
			}
		}
	}

	public function actionGetItemsList(){
		echo AboutusSlider::getItemsList();
	}
	public function actionSaveTextPosition()
	{
		$id = Yii::app()->request->getPost('id');
		$left = Yii::app()->request->getPost('left');
		$top = Yii::app()->request->getPost('top');
		$color = Yii::app()->request->getPost('color');
		$model = $this->loadModel($id);
		$model->left=$left;
		$model->top=$top;
		$model->text_color=$color;
		$model->update();
	}
}
