<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.11.2015
 * Time: 17:09
 */

class InvoicesController extends CController{

    public $layout = 'main';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index'),
                'expression'=>array($this, 'isAccountant'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном бухгалтера сайту.",
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
        );
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Invoice('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Invoice']))
            $model->attributes=$_GET['Invoice'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }
}