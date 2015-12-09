<?php

class AdminController extends TeacherCabinetController {

    public function actionIndex(){
        $this->renderPartial('index');
    }

}