<?php

class ExternalSourcesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial('view',array(
            'model'=>$this->loadModel($id),
        ), false, true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new ExternalSources;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ExternalSources']))
        {
            $model->attributes=$_POST['ExternalSources'];
            if($model->save())
                $this->redirect($this->pathToCabinet());
        }

        $this->renderPartial('create',array(
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

        if(isset($_POST['ExternalSources']))
        {
            $model->attributes=$_POST['ExternalSources'];
            if($model->save())
                $this->redirect($this->pathToCabinet());
        }

        $this->renderPartial('update',array(
            'model'=>$model,
        ), false, true);
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
            $this->redirect($this->pathToCabinet());
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
       $sources = ExternalSources::model()->findAll();

        $this->renderPartial('index',array(
            'sources'=>$sources,
        ), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ExternalSources the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=ExternalSources::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ExternalSources $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='external-sources-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}