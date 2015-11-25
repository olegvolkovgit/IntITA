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
        $arr['condition'] = Yii::app()->request->getPost('condition', '');
        $arr['question'] = Yii::app()->request->getPost('question', '');
        $arr['lecture'] = Yii::app()->request->getPost('lecture', 0);
        $arr['author'] = Yii::app()->request->getPost('author', null);
        $arr['pageId'] =  Yii::app()->request->getPost('pageId', 1);
        $arr['type'] = 'skip_task';

        if ($arr['condition']) {
            QuizFactory::factory($arr);
        }

        if (isset($_SERVER["HTTP_REFERER"]))
            $this->redirect($_SERVER["HTTP_REFERER"]);
        else $this->redirect(Yii::app()->homeUrl);
    }
}