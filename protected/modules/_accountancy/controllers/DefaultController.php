<?php

class DefaultController extends AccountancyController
{
    public $layout = 'main';

    public $menu=array();

    public $breadcrumbs = array();

	public function actionIndex()
	{
        if ($this->isAccountant()) {
            $this->render('index');
        } else {
            throw new CHttpException(403, "У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном бухгалтера сайту.");
        }
	}

    public function actionNotice(){
        $this->renderPartial('notice');
    }
}