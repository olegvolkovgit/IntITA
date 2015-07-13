<?php

class TaskController extends Controller
{
	public function actionAddTask()
	{
        $this->redirect(Yii::app()->request->urlReferrer);
	}


}