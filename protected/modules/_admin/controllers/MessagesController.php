<?php

class MessagesController extends AdminController
{
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
		$model = new Translate();
        $idMessage = Yii::app()->request->getPost('id', '');
        $category = Yii::app()->request->getPost('category', '');
        $translateUa = Yii::app()->request->getPost('translateUa', '');
        $translateRu = Yii::app()->request->getPost('translateRu', '');
        $translateEn = Yii::app()->request->getPost('translateEn', '');
        $comment = Yii::app()->request->getPost('comment', '');

		if(isset($_POST['category']))
		{
            if(Sourcemessages::model()->exists('id=:id', array(':id' => $idMessage))){
                throw new CHttpException(403,
                    'Запис з таким id вже є в базі даних. Id повідомлення не може повторюватися.');
            }
            //add source message
            $result = Sourcemessages::addSourceMessage($idMessage, $category, str_pad("".$idMessage, 4, 0, STR_PAD_LEFT));
            // if added source message, then add translations
            if($result){
                Translate::addNewRecord($idMessage, 'ua', $translateUa);
                Translate::addNewRecord($idMessage, 'ru', $translateRu);
                Translate::addNewRecord($idMessage, 'en', $translateEn);

                MessageComment::addMessageCodeComment($idMessage, $comment);
            }
                $this->actionIndex();
		} else {

            $this->render('create', array(
                'model' => $model,
            ));
        }
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


		if(isset($_POST['Translate']))
		{
			$model->attributes=$_POST['Translate'];
			if($model->save()) {
                MessageComment::updateMessageCodeComment($_POST['Translate']['id'], $_POST['Translate']['comment']);
                $this->redirect(array('view', 'id' => $model->id_record));
            }
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
        $model=new Translate('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Translate']))
            $model->attributes=$_GET['Translate'];

		$this->render('index',array(
            'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Translate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Translate']))
			$model->attributes=$_GET['Translate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Messages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Translate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Messages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='messages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
