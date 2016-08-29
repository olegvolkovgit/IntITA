<?php

class FreeLecturesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex(){
        $this->renderPartial('index', array(),false,true);
    }

    public function actionGetFreeLecturesList($count=10, $page=1, $searchCondition=null){
        $list = new Lecture();
        $sorting = [];
        if (isset($_GET['sorting']))
            $sorting = $_GET['sorting'];
        echo  $list->getLecturesList($count, $page, $searchCondition, $sorting );
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