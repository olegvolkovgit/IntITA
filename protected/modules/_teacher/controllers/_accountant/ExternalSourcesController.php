<?php

class ExternalSourcesController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAccountant();
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

    public function actionGetSources() {
        $models = ExternalSources::model()->findAll();
        echo json_encode(ActiveRecordToJSON::toAssocArray($models));
    }

    public function actionGetSourcesList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('ExternalSources', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
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
        $this->renderPartial('form', array('scenario'=>'create'), false, true);
    }
    public function actionCreateExternalSource()
    {
        $name=Yii::app()->request->getParam('name');
        $cash=Yii::app()->request->getParam('cash');
        
        $model=new ExternalSources;
        $model->name=$name;
        $model->cash=$cash;
       
        if($model->validate()){
            $model->save();
            echo 'Зовнішнє джерело успішно створено';
        }else{
            echo $model->getValidationErrors();
        }
    }

    public function actionUpdate($id)
    {
        $this->renderPartial('form', array('scenario'=>'update'), false, true);
    }

    public function actionUpdateExternalSource()
    {
        $id=Yii::app()->request->getParam('id');
        $name=Yii::app()->request->getParam('name');
        $cash=Yii::app()->request->getParam('cash');

        $model=ExternalSources::model()->findByPk($id);
        $model->name=$name;
        $model->cash=$cash;

        if($model->validate()){
            $model->update();
            echo 'Зовнішнє джерело коштів оновлено';
        }else{
            echo $model->getValidationErrors();
        }
    }

    public function actionDelete()
    {
        $this->loadModel(Yii::app()->request->getParam('id'))->delete();
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

    public function actionGetExternalSource()
    {
        $model=ExternalSources::model()->findByPk(Yii::app()->request->getParam('id'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        echo CJSON::encode($model);
    }
}