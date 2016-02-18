<?php

class FreeLecturesController extends TeacherCabinetController
{
    public function actionIndex(){
        $this->renderPartial('index', array(),false,true);
    }

    public function actionGetFreeLecturesList(){
        echo Lecture::getLecturesList();
    }

    public function actionSetFreeLessons($id)
    {
        return Lecture::model()->updateByPk($id, array('isFree' => 1));
    }

    public function actionSetPaidLessons($id)
    {
        return Lecture::model()->updateByPk($id, array('isFree' => 0));
    }
}