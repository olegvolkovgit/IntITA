<?php

class LectureController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionLecturesList()
    {
        $this->renderPartial('_lectures_table', array(), false, true);
    }

    public function actionGetLecturesList(){
        echo Lecture::getAllLecturesList();
    }
}