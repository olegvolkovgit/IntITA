<?php

class AdminController extends TeacherCabinetController {

    public function actionIndex(){
        $this->renderPartial('index');
    }

    public function actionFreeLectures(){
        $model = new Lecture('search');
        $model->unsetAttributes();

        if (isset($_GET['Lecture']))
            $model->attributes = $_GET['Lecture'];

        $this->render('_freeLectures', array(
            'model' => $model,
        ));
    }

    public function actionVerifyContent(){
        $this->renderPartial('_verifyContent');
    }

}