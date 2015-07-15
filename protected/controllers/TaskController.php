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
            'postOnly + addTask',
        );
    }

	public function actionAddTask()
	{

        $condition = Yii::app()->request->getPost('condition', '');
        $lecture =  Yii::app()->request->getPost('lecture', 0);
        $author = Yii::app()->request->getPost('author', null);
        $language = Yii::app()->request->getPost('language', 'C++');
        $assignment = Yii::app()->request->getPost('assignment', null);

        if ($condition){
            if ($lectureElementId = LectureElement::addNewTaskBlock($lecture, $condition)) {
                Task::addNewTask($lectureElementId, $language, $author);
            }

        }

        $this->redirect(Yii::app()->request->urlReferrer);
	}


}