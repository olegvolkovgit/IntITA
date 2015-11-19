<?php

class DefaultController extends TeacherCabinetController
{
    public $layout = 'main';

	public function actionIndex()
	{
		$this->render('index');
	}
}