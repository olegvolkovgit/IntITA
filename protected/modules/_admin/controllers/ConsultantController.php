<?php

class ConsultantController extends AdminController
{
	public function actionIndex()
	{
        $criteria = null;

        $answer = new PlainTaskAnswer('search');
		$this->render('index',
            array('answer' => $answer,
                ));
	}

    public function actionAddConsult($idAnswer)
    {
        $answer = PlainTaskAnswer::model()->findByPk($idAnswer);
        $teachers = Teacher::model()->findAll();
        $this->render('addConsult',
            array('answer' => $answer,
                    'teachers' => $teachers));
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