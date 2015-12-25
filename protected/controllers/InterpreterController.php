<?php

/**
 * Created by PhpStorm.
 * User: ����
 * Date: 16.11.2015
 * Time: 14:35
 */
class InterpreterController extends Controller
{
    public $layout = 'lessonlayout';

    public function actionIndex()
    {
        $this->render('index');
    }
}