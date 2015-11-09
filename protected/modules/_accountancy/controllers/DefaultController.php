<?php

class DefaultController extends CController
{
    public $layout = 'main';

    public $menu=array();

    public $breadcrumbs = array();

    public function init()
    {
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
    }

	public function actionIndex()
	{
        if ($this->isAccountant()) {
            $this->render('index');
        } else {
            throw new CHttpException(403, "У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном бухгалтера сайту.");
        }
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

    public function actionNotice(){
        $this->renderPartial('notice');
    }
}