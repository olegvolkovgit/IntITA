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

//    public function accessRules()
//    {
//
//        return array(
//            array('allow',
//                //'actions'=>array('index', 'notice'),
//                'expression'=>array($this, 'isAdministrator'),
//            ),
//            array('deny',
//                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
//                Для отримання доступу увійдіть з логіном адміністратора сайту.",
//                //'actions'=>array('index','notice'),
//                'users'=>array('*'),
//            ),
//        );
//    }

}