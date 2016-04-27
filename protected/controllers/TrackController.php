<?php

class TrackController extends Controller
{
	public function actionIndex()
	{
		// $arr=[];
		// $arr['valera'] = Yii::app()->request->getPost('user');
		// $arr['time'] = Yii::app()->request->getPost('part');
		// $arr['name'] = Yii::app()->request->getPost('events');
		// $arr['vvvv'] = Yii::app()->request->getPost('lesson');
		//$tmp= new EventsFactoryController;
		$event = Yii::app()->request->getPost('events');
		$lesson = Yii::app()->request->getPost('lesson',0);
		$part = Yii::app()->request->getPost('part',0);
		$user_id = Yii::app()->user->id;
		$Model = EventsFactory::TrackEvent($event);
		//$TrackEvent= new TrackVideoModel();

		$Model->TrackEvent($user_id,$lesson,$part);

		//$f = new LogTracks();
		//$f->Track_lessons(Yii::app()->user->id,Yii::app()->request->getPost('part'),Yii::app()->request->getPost('events'),Yii::app()->request->getPost('lesson'));



		$this->render('index');
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
