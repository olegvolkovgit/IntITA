<?php

class SchedulerTasksController extends TeacherCabinetController
{

    public function hasRole(){
        return (!Yii::app()->user->model->isStudent() || !Yii::app()->user->model->isTenant());
    }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $_model = $this->loadModel($id);
        switch ($_model->type){
            case 1:
                $this->renderPartial('_newsletter');
                break;
        }
	}

    public function actionEdit($id)
    {
        $model = $this->loadModel($id);
        switch ($model->type){
            case 1:
                if ($model->status==SchedulerTasks::STATUSNEW){
                    $model->status = SchedulerTasks::STATUSCANCEL;
                    $model->save();
                };

                Yii::app()->runController('_teacher/newsletter/index');
                break;
        }
    }

	public function actionGetModel(){
        if (isset($_GET['id'])){
            $_model = $this->loadModel($_GET['id']);
            echo json_encode($_model->attributes);
        }

    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SchedulerTasks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SchedulerTasks']))
		{
			$model->attributes=$_POST['SchedulerTasks'];
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

		if(isset($_POST['SchedulerTasks']))
		{
			$model->attributes=$_POST['SchedulerTasks'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
	 * @return SchedulerTasks the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SchedulerTasks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SchedulerTasks $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='scheduler-tasks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetTasksList(){
        $adapter = new NgTableAdapter('SchedulerTasks',$_GET);
        echo json_encode($adapter->getData());
    }

    public function actionCancelTask(){
        if (isset($_POST['id'])){
            $task = $this->loadModel($_POST['id']);
            $task->status = SchedulerTasks::STATUSCANCEL;
            if ($task->save()){
                echo 'success';
            }
            else
                echo 'error';
        }

    }
}
