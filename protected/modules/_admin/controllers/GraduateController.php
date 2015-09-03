<?php
class GraduateController extends CController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='main';
    public $menu = array();
    /**
     * @return array action filters
     */

    public function init()
    {
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            die();
        }
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('delete', 'create', 'edit', 'index', 'admin'),
                'expression'=>array($this, 'isAdministrator'),
            ),
            array('deny',
                'message'=>"У вас недостатньо прав для перегляду та редагування сторінки.
                Для отримання доступу увійдіть з логіном адміністратора сайту.",
                'actions'=>array('delete', 'create', 'edit', 'index', 'admin'),
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
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id)
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Graduate;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Graduate']))
        {
            $model->attributes = $_POST['Graduate'];
            $model->avatar = CUploadedFile::getInstance($model,'avatar');

            if($model->save()){
                if(!empty($model->avatar)) {
                    $path = Yii::getPathOfAlias('webroot') . '/images/graduates/' . $model->avatar->getName();
                    $model->avatar->saveAs($path);
                } else {
                    $model->avatar = 'noname2.png';
                    $model->save();
                }
                $this->redirect('/IntITA/_admin/graduate/index');
            }
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Graduate']))
        {
            $model->attributes=$_POST['Graduate'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('update',array(
            'model'=>$model
        ));
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Graduate('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Graduate']))
            $model->attributes=$_GET['Graduate'];
        $dataProvider=new CActiveDataProvider('Graduate');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'model' => $model,
        ), false, true);
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Graduate('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Graduate']))
            $model->attributes=$_GET['Graduate'];
        $this->render('admin',array(
            'model'=>$model
        ));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Graduate the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Graduate::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    /**
     * Performs the AJAX validation.
     * @param Graduate $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='graduate-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}