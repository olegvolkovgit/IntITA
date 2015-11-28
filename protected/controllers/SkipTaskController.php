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

        $arr = $this->fillArr();

        if($arr['condition'])
        {
            $skipTask = SkipTask::model()->findByAttributes(array('condition' => $arr['id_block']));

            if($skipTask)
            {
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
        $skipTask->question = LectureElement::editSkipTask($skipTask->question,$arr['question']);
        $skipTask->save();
    }

    public function actionSaveSkipAnswer()
    {
        $isDone = true;
        $mark = 0;
        $answers = $_POST['answers'];
        //$answers array with 3 value; first = skipText; second = order; third = caseInsensitive;

        $quizId = $_POST['id'];

        $skipTaskAnswers = SkipTask::model()->findByAttributes(array('condition' => $quizId))->skipTaskAnswers;

        usort($skipTaskAnswers, function($a, $b)
        {
            return strcmp($a->answer_order, $b->answer_order);
        });

        for($i = 0;$i < count($skipTaskAnswers);$i++)
        {
            $answer = $answers[$i][0];
            $taskAnswer = $skipTaskAnswers[$i]->answer;
            if($answers[$i][2] != 1)
            {
                $answer = strtoupper($answer);
                $taskAnswer = strtoupper($taskAnswer);
            }

            if(strcmp($answer,$taskAnswer) != 0)
            {
                $mark= 0;
                $isDone = false;
            }
            else
            {
                $mark = 1;
            }
            $skipTaskMarks = new SkipTaskMarks();
            $skipTaskMarks->mark = $mark;
            $skipTaskMarks->user =(int)Yii::app()->user->id;
            $skipTaskMarks->id_task_answer = $skipTaskAnswers[$i]->id;
            if(!$skipTaskMarks->save())
                throw new \application\components\Exceptions\IntItaException('Skip task was not saved!!!');
        }

        if(!$isDone)
            echo false;

        else
            echo true;
        }

}