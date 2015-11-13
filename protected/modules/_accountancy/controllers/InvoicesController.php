<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.11.2015
 * Time: 17:09
 */

class InvoicesController extends AccountancyController
{

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
            array('allow',
                'actions'=>array('index', 'agreementList'),
                'expression'=>array($this, 'isAccountant'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном бухгалтера сайту.",
                'actions'=>array('index', 'agreementList'),
                'users'=>array('*'),
            ),
        );
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

    public function actionAgreementList(){
        $model= new Invoice('search');
        $model->unsetAttributes();
        if(isset($_GET['Invoice']))
            $model->attributes=$_GET['Invoice'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }
}