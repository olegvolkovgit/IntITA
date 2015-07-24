<?php

class TaskController extends Controller
{
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

	public function actionAddTask()
	{
        $condition = Yii::app()->request->getPost('condition', '');
        $lecture =  Yii::app()->request->getPost('lecture', 0);
        $author = Yii::app()->request->getPost('author', null);
        $language = Yii::app()->request->getPost('language', 'C++');
        $assignment = Yii::app()->request->getPost('assignment', 0);
        $table = Yii::app()->request->getPost('table', '');
        $taskType = Yii::app()->request->getPost('taskType', 'plain');

        if ($condition){
            if ($lectureElementId = LectureElement::addNewTaskBlock($lecture, $condition, $taskType)) {
                Task::addNewTask($lectureElementId, $language, $author, $assignment, $table);
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
	}

    public function actionSetMark()
    {
        $status = Yii::app()->request->getPost('status', '');
        $result =  Yii::app()->request->getPost('result', '');
        $task = Yii::app()->request->getPost('task', 0);
        $user = Yii::app()->request->getPost('user', 0);
        $date = Yii::app()->request->getPost('date', 0);
        $warning = Yii::app()->request->getPost('warning', '');

        TaskMarks::addMark($user, $task, $status, $result, $date, $warning);
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}