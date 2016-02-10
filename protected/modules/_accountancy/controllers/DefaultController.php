<?php

class DefaultController extends AccountancyController
{
    public $layout = 'main';

    public $menu = array();

    public $breadcrumbs = array();

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionNotice()
    {
        $this->renderPartial('notice');
    }
}