<?php

class DefaultController extends CController
{

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'expression'=>array($this, 'isAdministrator'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
        );
    }

    function isAdministrator()
    {
        if(AccessHelper::isAdmin())
            return true;
        else
            return false;
    }

	public function actionIndex()
	{
		$this->render('index');
	}
}