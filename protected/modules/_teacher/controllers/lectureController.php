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

    public function actionInitializeDir()
    {
        if (!file_exists(Yii::app()->basePath . "/../content")) {
            mkdir(Yii::app()->basePath . "/../content");
        }
        $this->initializeImagesAudioFolders();
        $this->initializeModules();
        $this->initializeLectures();
    }

    public function initializeImagesAudioFolders()
    {
        if (!file_exists(Yii::app()->basePath . "/../content/images")) {
            mkdir(Yii::app()->basePath . "/../content/images");
        }
        if (!file_exists(Yii::app()->basePath . "/../content/audio")) {
            mkdir(Yii::app()->basePath . "/../content/audio");
        }
    }

    public function initializeModules()
    {
        $modules = Module::model()->findAll();
        foreach ($modules as $record) {
            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->module_ID)) {
                mkdir(Yii::app()->basePath . "/../content/module_" . $record->module_ID);
            }
        }
    }

    public function initializeLectures()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('idModule>0');
        $lectures = Lecture::model()->findAll($criteria);

        foreach ($lectures as $record) {
            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id)) {
                mkdir(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id);
            }
//            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/images")) {
//                mkdir(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/images");
//            }
//            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/audio")) {
//                mkdir(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/audio");
//            }
        }
    }
}