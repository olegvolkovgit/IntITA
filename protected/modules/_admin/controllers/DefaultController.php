<?php

class DefaultController extends AdminController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionNotice(){
        $this->renderPartial('notice');
    }
}