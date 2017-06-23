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

	public function actionGetModel(){
        if (isset($_GET['id'])){

			$model=SchedulerTasks::model()->with(['user', 'newsletter'])->findByPk($_GET['id']);
			if (OwnerPermission::isOwner($model) || Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSupervisor()) {
				$data = $model->attributes;
				$data['fullName']=$model->user->fullName;
				$data['newsletter']= $model->newsletter->attributes;
				if (isset($data['newsletter']['recipients'])){

				    $recipients = [];
				    switch ($data['newsletter']['type']){
                        case 'roles':{
                            $_recipients = unserialize($data['newsletter']['recipients']);
                            foreach ($_recipients as $role)
                                array_push($recipients,Role::getInstance($role)->title());
                            break;
                        }
                        case 'users':{
                            $_recipients = unserialize($data['newsletter']['recipients']);
                            $users = StudentReg::model()->findAll((new CDbCriteria())->addInCondition('email',$_recipients));
                            foreach ($users as $user)
                            array_push($recipients,$user->fullName());
                            break;
                        }
                        case "groups":{
                            $_recipients = unserialize($data['newsletter']['recipients']);
                            $groups = OfflineGroups::model()->findAll((new CDbCriteria())->addInCondition('id',$_recipients));
                            foreach ($groups as $group)
                                array_push($recipients,$group->name);
                            break;
                        }
                        case "subGroups":{
                            $_recipients = unserialize($data['newsletter']['recipients']);
                            $subGroups = OfflineSubgroups::model()->with(['groupName'])->findAll((new CDbCriteria())->addInCondition('t.id',$_recipients));
                            foreach ($subGroups as $subGroupe)
                                array_push($recipients,'<'.$subGroupe->groupName->name.'>'.$subGroupe->name);
                            break;
                        }
                        case "emailsFromDatabase":{
                            if ($data['newsletter']['recipients'] > 0){
                                $emailCategory = EmailsCategory::model()->findByPk($data['newsletter']['recipients']);
                                array_push($recipients,$emailCategory->title);
                            }
                            else
                            {
                                array_push($recipients,"Вся база e-mail");
                            }


                        }

                    }
                    $data['newsletter']['recipients'] = implode(', ' ,$recipients);
                }
				echo json_encode($data);
			}
			else throw new CHttpException(403, 'Access denied!');
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
		if (!Yii::app()->user->model->isAdmin() || !Yii::app()->user->model->isSupervisor())
		{

				$adapter->mergeCriteriaWith((new CDbCriteria())->addCondition('t.type=1 AND t.created_by='.Yii::app()->user->id));
		}
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
