<?php

class SchedulerTasksController extends TeacherCabinetController
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
        $_model = $this->loadModel($id);
		if (OwnerPermission::isOwner($_model) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()) {
			switch ($_model->type) {
				case 1:
					$this->renderPartial('_newsletter');
					break;
			}
		}
		else throw new CHttpException(403, 'Access denied!');
	}

    public function actionEdit($id)
    {
        $model = $this->loadModel($id);
		if (OwnerPermission::isOwner($model) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()) {
			switch ($model->type) {
				case 1:
					if ($model->status == SchedulerTasks::STATUSNEW) {
						$model->status = SchedulerTasks::STATUSCANCEL;
						$model->save();
					};

					Yii::app()->runController('_teacher/newsletter/index');
					break;
			}
		}
		else throw new CHttpException(403, 'Access denied!');
    }

    public function actionGetModel($id){
        $model=SchedulerTasks::model()->with(['user', 'newsletter'])->findByPk((int)$id);
        if (OwnerPermission::isOwner($model) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()) {
            switch ($model->type){
                case TaskFactory::NEWSLETTER:{
                    $data = $model->attributes;
                    $model->newsletter->getRecipients();
				    $data['fullName']=$model->user->fullName;
				    $data['newsletter']= $model->newsletter->attributes;

				    echo CJSON::encode($data);
				    break;
                }
            }
        }
        else throw new CHttpException(403, 'Access denied!');
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
		if (OwnerPermission::isOwner($model) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()) {
			if (isset($_POST['SchedulerTasks'])) {
				$model->attributes = $_POST['SchedulerTasks'];
				if ($model->save())
					$this->redirect(array('view', 'id' => $model->id));
			}

			$this->render('update', array(
				'model' => $model,
			));
		}
		else throw new CHttpException(403,'Access denied!');
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
		$criteria = new CDbCriteria();
		$criteria->with = ['newsletter'];
        $criteria->addCondition("newsletter.type!='taskNotification'");
		$criteria->addCondition('t.type='.TaskFactory::NEWSLETTER);
		if (!Yii::app()->user->model->isAdmin() || !Yii::app()->user->model->isSupervisor())
		{

				$criteria->addCondition('t.created_by='.Yii::app()->user->id);
		}
        $adapter->mergeCriteriaWith($criteria);
		echo json_encode($adapter->getData($_POST));
		Yii::app()->end();

    }

    public function actionCancelTask(){
        if (isset($_POST['id'])){
            $task = $this->loadModel($_POST['id']);
			if (OwnerPermission::isOwner($task) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()){
				$task->status = SchedulerTasks::STATUSCANCEL;
				if ($task->save()){
					echo 'success';
				}
				else
					echo 'error';	
			}
			else throw new CHttpException(403,'Access denied');
        }

    }

	public function actionDeleteTask(){
		$id = (int)$_POST['id'];
		if($id){
			$task = $this->loadModel($id);
			if (OwnerPermission::isOwner($task) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()){
				if ($task->delete()){
					echo true;
				}
				else{
					echo false;
				}

			}
			else throw new CHttpException(403,'Access denied');
		}
		else throw new CHttpException(400,'Bad request');
	}
}
