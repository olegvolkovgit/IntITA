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
        $editMode =  Yii::app()->request->getPost('editMode', 0);

        $answersArray = explode(',', $answers);

        if ($editMode == 0) {
            if (TestsAnswers::checkTestAnswer($user, $test, $answersArray, $testType)) {
                TestsMarks::addTestMark($user, $test, 1);
            } else {
                TestsMarks::addTestMark($user, $test, 0);
            }
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
            'postOnly + checkTestAnswer, getTestResult',
        );
    }

    /*
     * Receive user and test id by post, get last test mark for this user/test  and send JSON with mark.
     */
    public function actionGetTestResult(){
        $rawdata = file_get_contents('php://input');

        $request = json_decode($rawdata);
        $user = $request->user;
        $test =  $request->test;

        if (TestsMarks::model()->exists('id_user =:user and id_test =:test', array(':user' => $user, ':test' => $test))){
            $criteria = new CDbCriteria;
            $criteria->order = 'id DESC';

            $result = TestsMarks::model()->findByAttributes(
                array('id_user' => $user, 'id_test' => $test),
                $criteria
            )->mark;
        } else {
            $result = "not found";
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $resultJSON = array(
            "user" => $user,
            "test" => $test,
            "status" => $result,
        );
        echo json_encode($resultJSON);
    }
}