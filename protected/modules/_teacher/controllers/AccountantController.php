<?php

class AccountantController extends TeacherCabinetController{

    public function actionIndex(){
        $this->renderPartial('index');
    }
}