<?php

class VerifyContentController extends TeacherCabinetController
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionInitializeDir()
    {
        if (!file_exists(Yii::app()->basePath . "/../content")) {
            mkdir(Yii::app()->basePath . "/../content");
        }
        $this->initializeModules();
        $this->initializeLectures();

        $this->redirect($this->pathToCabinet());
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
            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/images")) {
                mkdir(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/images");
            }
            if (!file_exists(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/audio")) {
                mkdir(Yii::app()->basePath . "/../content/module_" . $record->idModule . "/lecture_" . $record->id . "/audio");
            }
        }
    }

    public function actionConfirm($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model) {
            $model->updateByPk($id, array('verified' => '1'));
            $this->generateLecturePages($model);
        } else {
            throw new CException("Такої лекції немає!");
        }

        $this->redirect($this->pathToCabinet());
    }

    public function actionCancel($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model) {
            $model->verified = 0;
            $model->save();
        } else {
            throw new CException("Такої лекції немає!");
        }
        $this->redirect($this->pathToCabinet());
    }

    public function generateLecturePages(Lecture $model)
    {
        $this->redirect(Config::getBaseUrl() . '/lesson/saveLectureContent/?idLecture=' . $model->id);
    }


}