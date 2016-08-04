<?php

class VerifyContentController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin() ||  Yii::app()->user->model->isContentManager();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
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

    public function actionConfirm($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model) {
            $model->setVerified();
            $this->generateLecturePages($model);
        } else {
            throw new CException("Такої лекції немає!");
        }
    }

    public function actionCancel($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model) {
            $model->setNoVerified();
            $this->deleteLecturePages($model);
        } else {
            throw new \application\components\Exceptions\IntItaException(404, "Такої лекції немає!");
        }
    }

    public function generateLecturePages(Lecture $model)
    {
        $this->redirect(Config::getBaseUrl() . '/lesson/saveLectureContent/?idLecture=' . $model->id);
    }
    public function deleteLecturePages(Lecture $model)
    {
        $this->redirect(Config::getBaseUrl() . '/lesson/deleteLectureContent/?idLecture=' . $model->id);
    }
    public function actionWaitLecturesList(){
        echo Lecture::getLecturesListByStatus(Lecture::NOVERIFIED);
    }

    public function actionVerifiedLecturesList(){
        echo Lecture::getLecturesListByStatus(Lecture::VERIFIED);
    }
}