<?php

class AdminController extends TeacherCabinetController {

    public function init()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, 'Bad request.');
        }
    }

    public function actionIndex(){
        $this->renderPartial('index', array(), false, true);
    }

    public function actionFreeLectures(){
        $model = new Lecture('search');
        $model->unsetAttributes();

        if (isset($_GET['Lecture']))
            $model->attributes = $_GET['Lecture'];

        $this->renderPartial('_freeLectures', array(
            'model' => $model,
        ),false,true);
    }

    public function actionVerifyContent(){
        $this->renderPartial('_verifyContent');
    }

}