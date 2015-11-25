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
            else return false;
        }


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
            $skipTask = SkipTask::model()->findByAttributes(array('question' => $arr['id_block']));
            if($skipTask)
            {
                $this->saveSkiP($skipTask,$arr);
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
    }

    private function fillArr()
    {
        $arr['condition'] = Yii::app()->request->getPost('condition', '');
        $arr['question'] = Yii::app()->request->getPost('question', '');
        $arr['lecture'] = Yii::app()->request->getPost('lecture', 0);
        $arr['author'] = Yii::app()->request->getPost('author', null);
        $arr['pageId'] =  Yii::app()->request->getPost('pageId', 1);
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
}