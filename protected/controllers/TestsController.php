<?php

class TestsController extends Controller
{
	public function actionAddTest()
	{
        $lecture = Yii::app()->request->getPost('lectureId', 0);
        $condition =  Yii::app()->request->getPost('condition', '');
        $testTitle = Yii::app()->request->getPost('testTitle', '');
        $optionsNum = Yii::app()->request->getPost('optionsNum', 0);

        $options = [];

        for ($i = 0; $i < $optionsNum; $i++){
            $temp = "option".($i+1);
            $options[$i]["option"] = Yii::app()->request->getPost($temp, '');
            $options[$i]["isTrue"] = Yii::app()->request->getPost("answer".($i+1), 0);
        }
        $author = Yii::app()->request->getPost('author', 0);
        if ($lectureElementId = LectureElement::addNewTestBlock($lecture, $condition)) {
            Tests::addNewTest($lectureElementId, $testTitle, $author);
            $idTest = Tests::model()->findByAttributes(array('block_element' => $lectureElementId))->id;
            TestsAnswers::addOptions($idTest, $options);
        }

        $this->redirect(Yii::app()->request->urlReferrer);
	}

    public function actionCheckTestAnswer(){
        $user = Yii::app()->request->getPost('user', '');
        $test =  Yii::app()->request->getPost('test', '');
        $answers = Yii::app()->request->getPost('answers', '');
        $testType = Yii::app()->request->getPost('testType', 1);

        $answersArray = explode(',', $answers);

        if (TestsAnswers::checkTestAnswer($user, $test, $answersArray, $testType)){
            var_dump('true');
        } else {
            var_dump('false');
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + checkTestAnswer',
        );
    }
/*
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