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
}