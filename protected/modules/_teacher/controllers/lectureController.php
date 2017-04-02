<?php

class LectureController extends TeacherCabinetController
{
    public function hasRole(){
        return (Yii::app()->user->model->isAdmin() && !in_array(Yii::app()->controller->action->id,['lecturesList', 'getLecturesList'])) ||
        Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionLecturesList()
    {
        $this->renderPartial('_lectures_table', array('organization'=>false), false, true);
    }

    public function actionOrganizationLecturesList()
    {
        $this->renderPartial('_lectures_table', array('organization'=>true), false, true);
    }
    
    public function actionGetLecturesList(){
        echo Lecture::getAllLecturesList();
    }

    public function actionGetOrganizationLecturesList(){
        echo Lecture::getOrganizationLecturesList(Yii::app()->user->model->getCurrentOrganization()->id);
    }
}