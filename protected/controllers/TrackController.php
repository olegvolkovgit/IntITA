<?php

class TrackController extends Controller
{
	public function actionIndex()
	{

		$event = Yii::app()->request->getPost('events');
		$lesson = Yii::app()->request->getPost('lesson',0);
		$part = Yii::app()->request->getPost('part',0);
		$user_id = Yii::app()->user->id;


		$Model = EventsFactory::trackEvent($event);
		$Model->trackEvent($user_id,$lesson,$part);

		$this->render('index');
	}

}
