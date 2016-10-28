<?php

class OperationTypeController extends TeacherCabinetController
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
        $model=new OperationType;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['OperationType']))
        {
            $model->attributes=$_POST['OperationType'];
            if($model->save())
                $this->redirect($this->pathToCabinet().'#/accountant/operationtype');
        }

        $this->renderPartial('create',array(
            'model'=>$model,
        ), false, true);
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

        if(isset($_POST['OperationType']))
        {
            $model->attributes=$_POST['OperationType'];
            if($model->save())
                $this->redirect($this->pathToCabinet().'#/accountant/operationtype');
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
    public function actionDelete()
    {
        if (isset($_POST['id']))
        {
            $id = $_POST['id'];
            return $this->loadModel($id)->delete();
        }


    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $types = OperationType::model()->findAll();

        $this->renderPartial('index',array(
            'types'=>$types,
        ), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OperationType the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=OperationType::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OperationType $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='operation-type-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLoadList(){
        $adapter = new NgTableAdapter('OperationType',$_GET);
        echo json_encode($adapter->getData());
    }
}