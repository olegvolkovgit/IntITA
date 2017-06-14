<?php

class VerifyContentController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isContentManager();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionConfirm($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model && $model->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id) {
            $model->setVerified();
            $this->generateLecturePages($model);
        } else {
            throw new CException("Такої лекції немає або у тебе не має до неї доступу");
        }
    }

    public function actionCancel($id)
    {
        $model = Lecture::model()->findByPk($id);

        if ($model && $model->module->id_organization==Yii::app()->user->model->getCurrentOrganization()->id) {
            $model->setNoVerified();
            $this->deleteLecturePages($model);
        } else {
            throw new CException("Такої лекції немає або у тебе не має до неї доступу");
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