<?php

class TestsController extends Controller
{
	public function actionAddTest()
	{
        $lecture = Yii::app()->request->getPost('lectureId', 0);
        $condition =  Yii::app()->request->getPost('condition', '');
        $testTitle = Yii::app()->request->getPost('testTitle', '');
        $optionsNum = Yii::app()->request->getPost('optionsNum', 0);
        $author = Yii::app()->request->getPost('author', 0);
        if ($lectureElementId = LectureElement::addNewTestBlock($lecture, $condition)) {
            Tests::addNewTest($lectureElementId, $testTitle, $author);
        }

        $this->redirect(Yii::app()->request->urlReferrer);
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