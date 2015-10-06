<?php

class DefaultController extends AdminController
{
//    public function init()
//    {
//        if (Config::getMaintenanceMode() == 1) {
//            $this->renderPartial('/default/notice');
//            Yii::app()->cache->flush();
//            die();
//        }
//    }

    public function actionIndex()
    {
        if (AccessHelper::isAdmin()) {
            $this->render('index');
        } else {
            throw new CHttpException(403, "У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.");
        }
    }

    public function actionNotice(){
        $this->renderPartial('notice');
    }
}