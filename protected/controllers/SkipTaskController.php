<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 24.11.2015
 * Time: 16:17
 */

class SkipTaskController extends Controller{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + addTask, setMark',
        );
    }

    public function actionAddTask(){

        $arr = $this->fillArr();
        if ($arr['condition']) {
            if (QuizFactory::factory($arr))
                $this->redirect(Yii::app()->request->urlReferrer);
        }
        return false;
    }

    public function actionEditSkipTask()
    {
        //in $arr['pageId'] was written LectureElement->id_block

        $arr = $this->fillArr();

        if($arr['condition'])
        {
            $skipTask = SkipTask::model()->findByAttributes(array('condition' => $arr['pageId']));

            if($skipTask)
            {

                SkipTaskAnswers::editAnswers($skipTask->id, $arr['answers']);
                $this->saveSkiP($skipTask,$arr);
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
    }

    private function fillArr()
    {
        $arr['text'] = Yii::app()->request->getPost('text', '');
        $arr['condition'] = Yii::app()->request->getPost('condition', '');
        $arr['question'] = Yii::app()->request->getPost('question', '');
        $arr['author'] = Yii::app()->request->getPost('author', null);
        $arr['pageId'] =  Yii::app()->request->getPost('page', 1);
        $arr['answers'] = Yii::app()->request->getPost('answer', null);
        $arr['type'] = 'skip_task';

        if(isset($_POST['id_block']))
            $arr['id_block'] = Yii::app()->request->getPost('id_block');

        return $arr;
    }

    private function saveSkiP($skipTask,$arr){
        $skipTask->condition = LectureElement::editSkipTask($skipTask->condition,$arr['condition']);
        $skipTask->question = LectureElement::editSkipTask($skipTask->question,$arr['text']);
        $skipTask->source = $arr['question'];
        $skipTask->save();

    }

    public function actionSaveSkipAnswer()
    {

        $quizId = $_POST['id'];
        $answers = $_POST['answers'];
        //$answers array with 3 value; first = skipText; second = order; third = caseInsensitive;
        $isDone = SkipTaskMarks::marksAnswer($quizId,$answers);
        if(!$isDone){
            echo 'not done';
        } else {
            $lastPage = LecturePage::checkLastQuiz($quizId);
            if ($lastPage && $isDone){
                $rating = RatingUserModule::model()->find('id_module=:idModule AND module_done=0 AND id_user=:idUser',[':idModule'=>SkipTaskMarks::model()->find('quiz_uid=:quiz',[':quiz'=>$quizId])->lecture->idModule, ':idUser'=>(int)Yii::app()->user->id]);
                if ($rating){
                    $rating->rateUser((int)Yii::app()->user->id);
                }
            }
            if($lastPage)
                echo 'lastPage';
            else echo 'done';
        }
    }

    public function actionUnableSkipTask()
    {
        $lecture =  Yii::app()->request->getPost('pageId',0);

        if($lecture != 0){
            LecturePage::unableQuiz($lecture);
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionDataSkipTask()
    {
        $idBlock = Yii::app()->request->getPost('idBlock');
        $data = [];
        $skipTask=LectureElement::model()->findByPk($idBlock);
        $data["condition"]=$skipTask->getSkipTaskCondition();
        $data["source"]=$skipTask->getSkipTaskSource();

        echo CJSON::encode($data);
    }
}