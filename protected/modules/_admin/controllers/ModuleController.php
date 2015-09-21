<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.09.2015
 * Time: 0:33
 */

class ModuleController extends CController{

    public $layout='main';

    public function init()
    {
        if (Config::getMaintenanceMode() == 1) {
            $this->renderPartial('/default/notice');
            Yii::app()->cache->flush();
            die();
        }
    }

    public function actionIndex(){

        $model=new Module('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Module']))
            $model->attributes=$_GET['Module'];

        $this->render('index',array(
            'model' => $model,
        ));
    }

    public function actionView($id)
    {
        $model = Module::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = Module::model()->findByPk($id);

        if (isset($_POST['Module'])) {
            $model->attributes = $_POST['Module'];

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->module_ID));
            }
        }
        $this->render('update', array(
            'model' => $model
        ));
    }

}