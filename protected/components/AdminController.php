<?php

class AdminController extends CController
{
    public $layout = 'main';

    public $menu = array();

    public $breadcrumbs = array();


    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function init()
    {
        $app = Yii::app();
        if (isset($app->session['lg'])) {
            $app->language = $app->session['lg'];
        }
        if (Yii::app()->user->isGuest) {
            $this->render('/default/authorize');
            Yii::app()->end();
        }
        if (!$this->isAdministrator()) {
            throw new CHttpException(403, 'У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.');
        }
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            Yii::app()->end();
        }

        $this->pageTitle = Yii::app()->name;
        date_default_timezone_set("UTC");
    }

    public function accessRules()
    {
        return array(
        );
    }

    public function isAdministrator()
    {
        return Yii::app()->user->model->isAdmin();
    }

    public function behaviors()
    {
        return array(
            'InlineWidgetsBehavior'=>array(
                'class'=>'DInlineWidgetsBehavior',
                'location'=>'application.components.widgets',
                'startBlock'=> '{{w:',
                'endBlock'=> '}}',
                'widgets'=>array(
                    'Share',
                    'Comments',
                    'AuthorizationFormWidget',
                ),
            ),
        );
    }
}