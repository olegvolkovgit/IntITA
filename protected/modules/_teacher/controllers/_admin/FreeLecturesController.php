<?php

class FreeLecturesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex(){
        $this->renderPartial('index', array(),false,true);
    }

    public function actionGetFreeLecturesList(){
        echo Lecture::getLecturesList();
    }

    public function actionSetFreeLessons($id)
    {
        $model = Lecture::model()->findByPk($id);
        return $model->setFree();
    }

    public function actionSetPaidLessons($id)
    {
        $model = Lecture::model()->findByPk($id);
        return $model->setPaid();
    }
}