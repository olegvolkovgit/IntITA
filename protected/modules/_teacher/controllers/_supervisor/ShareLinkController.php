<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 24.12.2015
 * Time: 16:17
 */

class ShareLinkController extends TeacherCabinetController {

    public function hasRole(){
        return Yii::app()->user->model->isSuperVisor() ||
            (Yii::app()->user->model->isSuperAdmin() && in_array(Yii::app()->controller->action->id,['shareLinksList']));
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model=$this->loadModel($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model);
        $this->renderPartial('view',array(
            'model'=>$model,
        ),false,true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new ShareLink;
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['ShareLink']))
        {
            $model->attributes=$_POST['ShareLink'];
            if($model->save())
                $this->redirect($this->pathToCabinet()."#/sharedlinks");
        }

        $this->renderPartial('create',array(
            'model'=>$model,
        ),false,true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model);
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['ShareLink']))
        {
            $model->attributes=$_POST['ShareLink'];
            if($model->save())
                $this->redirect($this->pathToCabinet()."#/sharedlinks");
        }
        $this->renderPartial('update',array(
            'model'=>$model,
        ),false,true);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {
        $id = Yii::app()->request->getPost('id');
        $model=$this->loadModel($id);
        Yii::app()->user->model->hasAccessToOrganizationModel($model);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionShareLinksList($allLinks=false){
        echo ShareLink::shareLinksList($allLinks);
    }
    /**
     * Lists all models.
     */
    public function actionIndex(){
        $model=new ShareLink('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ShareLink']))
            $model->attributes=$_GET['ShareLink'];

        $this->renderPartial('index',array(
            'model'=>$model,
        ),false,true);

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ShareLink the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=ShareLink::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ShareLink $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='share-link-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}