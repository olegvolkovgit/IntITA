<?php

class MailTemplatesController extends TeacherCabinetController
{


    public function hasRole(){
        return (Yii::app()->user->model->isAdmin()
            || Yii::app()->user->model->isAccountant()
            || Yii::app()->user->model->isTrainer()
            || Yii::app()->user->model->isAuthor()
            || Yii::app()->user->model->isContentManager()
            || Yii::app()->user->model->isTeacherConsultant()
            || Yii::app()->user->model->isSuperVisor()
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->renderPartial('_view');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MailTemplates;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MailTemplates']))
		{
            $model->attributes=$_POST['MailTemplates'];
			if($model->save())
				echo 'success';
            else
                echo 'error';
            Yii::app()->end();
		}

		$this->renderPartial('_form',array(
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

		if(isset($_POST['MailTemplates']))
		{
			$model->attributes=$_POST['MailTemplates'];
			if($model->save())
                echo 'success';
            else
                echo 'error';
            Yii::app()->end();
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
        if(isset($_POST['id'])) {
            if ($this->loadModel($_POST['id'])->delete())
                echo 'success';
            else
                echo 'error';
        }

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->renderPartial('index');
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MailTemplates the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MailTemplates::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MailTemplates $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mail-templates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetMailTemplates(){
		$adapter = new NgTableAdapter('MailTemplates',$_GET);
		echo json_encode($adapter->getData());
	}

	public function actionGetModel($id){
		echo json_encode($this->loadModel($id)->getAttributes());
	}

	public function actionGetMailTemplatesList($type = 0){
	    $criteria = new CDbCriteria();
        $criteria->select = ['id', 'title'];
	    if ($type){
	        $criteria->addCondition('template_type=:type');
	        $criteria->params = ['type'=>(int)$type];
        }
        header('Content-type: application/json');
        echo CJSON::encode(MailTemplates::model()->findAll($criteria));
        Yii::app()->end();
    }
}
