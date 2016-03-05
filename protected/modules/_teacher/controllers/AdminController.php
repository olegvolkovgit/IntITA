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
}