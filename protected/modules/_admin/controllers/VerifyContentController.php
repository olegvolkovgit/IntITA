<?php

class VerifyContentController extends AdminController {

    public function actionIndex(){
        $this->render('index');
    }

    public function actionInitializeDir(){
        if(!file_exists(Yii::app()->basePath . "/../content")){
            mkdir(Yii::app()->basePath . "/../content");
        }
        $this->initializeModules();
        $this->actionIndex();
    }

    public function initializeModules(){
        $modules = Module::model()->findAll();
        foreach($modules as $record){
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$record->module_ID)){
                mkdir(Yii::app()->basePath . "/../content/module_".$record->module_ID);
            }
        }
    }

}