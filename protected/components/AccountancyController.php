<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.11.2015
 * Time: 18:46
 */

class AccountancyController extends CController {

    public $layout = 'main';

    public function init()
    {
        $app = Yii::app();
        if (isset($app->session['lg'])) {
            $app->language = $app->session['lg'];
        }
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
        $this->pageTitle = Yii::app()->name;
        date_default_timezone_set("UTC");
    }

    //if user account has role 2 (accountant)
    function isAccountant()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 2) {

            return true;
        }
        return false;
    }

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'expression'=>array($this, 'isAccountant'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном бухгалтера сайту.",
                'users'=>array('*'),
            ),
        );
    }
}