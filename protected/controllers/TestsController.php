<?php

class TestsController extends Controller
{
	public function actionAddTest()
	{

        $arr['lecture'] = Yii::app()->request->getPost('lectureId', 0);
        $arr['condition'] = Yii::app()->request->getPost('condition', '');
        $arr['testTitle'] = Yii::app()->request->getPost('testTitle', '');
        $arr['optionsNum'] = Yii::app()->request->getPost('optionsNum', 0);
        $arr['isFinal'] = Yii::app()->request->getPost('testType', 'plain');
        $arr['pageId'] = Yii::app()->request->getPost('pageId', 0);
        $arr['author'] = Yii::app()->request->getPost('author', 0);
        $arr['type'] = 'tests';

        $options = [];
        for ($i = 0; $i < $arr['optionsNum']; $i++){
            $temp = "option".($i+1);
            $options[$i]["option"] = Yii::app()->request->getPost($temp, '');
            $options[$i]["isTrue"] = Yii::app()->request->getPost("answer".($i+1), 0);
        }

        $arr['options'] = $options;

        if(QuizFactory::factory($arr))
            $this->redirect(Yii::app()->request->urlReferrer);
	}
    public function actionEditTest()
    {
        $idBlock =  Yii::app()->request->getPost('idBlock', 0);
        $condition =  Yii::app()->request->getPost('condition', '');
        $testTitle = Yii::app()->request->getPost('testTitle', '');
        $optionsNum = Yii::app()->request->getPost('optionsNum', 0);

        $options = [];

        for ($i = 0; $i < $optionsNum; $i++){
            $temp = "option".($i+1);
            $options[$i]["option"] = Yii::app()->request->getPost($temp, '');
            $options[$i]["isTrue"] = Yii::app()->request->getPost("answer".($i+1), 0);
        }

        if (LectureElement::editTestBlock($idBlock, $condition)) {
            $idTest = Tests::model()->findByAttributes(array('block_element' => $idBlock))->id;
            TestsAnswers::editOptions($idTest, $options);
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionCheckTestAnswer(){
        $emptyanswers = [];
        $user = Yii::app()->request->getPost('user', '');
        $page = Yii::app()->request->getPost('page');
        $lesson = Yii::app()->request->getPost('lesson');
        $test =  Yii::app()->request->getPost('test', '');
        $answers = Yii::app()->request->getPost('answers', $emptyanswers);
        $testType = Yii::app()->request->getPost('testType', 1);
        $editMode =  Yii::app()->request->getPost('editMode', 0);

        if ($user!=0) {
            if (TestsAnswers::checkTestAnswer($test, $answers)) {
                TestsMarks::addTestMark($user, $test, 1);
                $event = 'TrueAnswer';
                $user_id = Yii::app()->user->id;
                $Model = EventsFactory::trackEvent($event);
                $Model->trackEvent($user_id,$lesson,$page);
            } else {
                TestsMarks::addTestMark($user, $test, 0);

                $event = 'FalseAnswer';
                $user_id = Yii::app()->user->id;
                $Model = EventsFactory::trackEvent($event);
                $Model->trackEvent($user_id,$lesson,$page);

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

        $lastTest=Tests::model()->isLastTest($test);

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

        if ($result && $lastTest){
            $lecture=TestsMarks::model()->find('id_test=:test',[':test'=>$test])->lecture;
            $rating = RatingUserModule::model()->find('id_module=:idModule AND module_done=0 AND id_user=:idUser',[':idModule'=>$lecture->idModule, ':idUser'=>$user]);
            if ($rating){
                $rating->rateUser($user);
            }
        }

        $resultJSON = array(
            "user" => $user,
            "test" => $test,
            "status" => $result,
            "lastTest" => $lastTest,
        );
        echo json_encode($resultJSON);
    }

    public function actionUnableTest(){
        $pageId = Yii::app()->request->getPost('pageId', 0);

        if($pageId != 0){
            LecturePage::unableQuiz($pageId);
        }
    }
    public function actionDataTest()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $data["condition"] =  Tests::getTestCondition($idBlock);
        $answers=TestsAnswers::getTestAnswers($idBlock);
        $valid=TestsAnswers::getTestValidCKE($idBlock);
        $data["answers"]=$answers;
        $data["valid"]=$valid;

        echo CJSON::encode($data);
    }
}