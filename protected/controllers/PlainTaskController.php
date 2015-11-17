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
        $arr = self::fillArr();

        if (QuizFactory::factory($arr))
            $this->redirect(Yii::app()->request->urlReferrer);
        else echo 'Task was not saved';

    }

    public function actionEditTask()
    {
        $arr = self::fillArr();

        if(LectureElement::editPlainTask($arr['id_block'],$arr['block_element']))
            $this->redirect(Yii::app()->request->urlReferrer);

        else echo 'Task was not saved';
    }

    private static function fillArr()
    {
        $arr['pageId'] =  Yii::app()->request->getPost('pageId');
        $arr['lecture'] = Yii::app()->request->getPost('lectureId');
        $arr['block_element'] = Yii::app()->request->getPost('block_element');
        $arr['author'] = Yii::app()->request->getPost('author');
        $arr['type'] = 'plain_task';

        if(isset($_POST['id_block']))
            $arr['id_block'] = Yii::app()->request->getPost('id_block');


        return $arr;
    }

    public function actionUnablePlainTask()
    {
        $lecture =  Yii::app()->request->getPost('pageId',0);

        if($lecture != 0){
            LecturePage::unableQuiz($lecture);
        }
        $this->redirect(Yii::app()->request->urlReferrer);

    }

    public function actionSaveAnswer()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $answer = Yii::app()->request->getPost('answer');
            $lectureId = Yii::app()->request->getPost('idLecture');
            $plainTask = PlainTask::getPlainTaskByLectureId($lectureId);
            $user = Yii::app()->user->id;

            $plainTaskAnswer = PlainTaskAnswer::fillHole($answer,$user,$plainTask->id);
                if($plainTaskAnswer->save())
                    return true;

                else
                    throw new PlainTaskException('Plain task was not saved');
        }


    }
}