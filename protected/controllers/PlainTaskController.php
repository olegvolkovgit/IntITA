<?php

use application\components\Exceptions\PlainTaskException as PlainTaskException;
class PlainTaskController extends Controller
{
	public function actionIndex()
	{
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

    public function actionAddTask()
    {

        $arr['pageId'] =  Yii::app()->request->getPost('pageId');
        $arr['lecture'] = Yii::app()->request->getPost('lectureId');
        $arr['block_element'] = Yii::app()->request->getPost('block_element');
        $arr['author'] = Yii::app()->request->getPost('author');
        $arr['type'] = 'plain_task';

        if (QuizFactory::factory($arr))
            $this->redirect(Yii::app()->request->urlReferrer);
        else echo 'Task was not saved';

    }


}