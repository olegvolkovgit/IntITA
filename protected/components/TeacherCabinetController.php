<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 17.11.2015
 * Time: 16:14
 */

class TeacherCabinetController extends CController
{

    public $layout = 'main';

    public $menu=array();

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
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }

        $this->pageTitle = Yii::app()->name;
        date_default_timezone_set("UTC");
    }

    public function accessRules()
    {
        return array(
            array('allow',
                // 'actions'=>array('delete', 'create', 'edit', 'index', 'admin'),
                'expression'=>array($this, 'isTeacher'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном вчителя сайту.",
                //'actions'=>array('index'),
                'users'=>array('*'),
            ),
        );
    }

    public function isTeacher()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 1) {

            return true;
        }
        return false;
    }
}