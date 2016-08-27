<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 24.12.2015
 * Time: 17:14
 */

class ResponseController extends TeacherCabinetController{

    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionView($id)
    {
        $model = Response::model()->findByPk($id);
        if(!$model){
            echo "Такого відгука немає.";
        } else {
            $this->renderPartial('view', array(
                'model' => $model,
            ), false, true);
        }
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
         $this->performAjaxValidation($model);

        if(isset($_POST['Response']))
        {
            $model->attributes=$_POST['Response'];
            if($model->save())
                $this->redirect(Yii::app()->createUrl('/_teacher/_admin/response/index'));
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
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        Yii::app()->db->createCommand("DELETE FROM teacher_response WHERE id_response=".$id)->execute();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        $this->renderPartial('index',array(),false,true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Response the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Response::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Response $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='response-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSetPublish($id)
    {
        $response=Response::model()->findByPk($id);
        $response->setPublish();
        $response->setTeacherRating();

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/response/index'));
    }

    public function actionUnsetPublish($id)
    {
        $response=Response::model()->findByPk($id);
        $response->setHidden();
        $response->setTeacherRating();

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->createUrl('/_teacher/_admin/response/index'));
    }


    public function actionUpdateResponseText($id){
        $response = Yii::app()->request->getPost('response', 'Пустий відгук');
        $publish = Yii::app()->request->getPost('publish', 0);
        if(Response::model()->updateByPk($id, array(
            'text' =>  trim(Response::model()->bbcode_to_html($response), chr(194) . chr(160) . chr(32) . " \t\n\r\0\x0B"),
            'is_checked' => $publish
        ))){
            echo 'Відгук успішно відредаговано';
        }else{
            echo 'Відгук відредагувати не вдалося';
        }
    }

    public function actionGetTeacherResponsesList(){
        echo Response::getTeacherResponsesData();
    }
    
    public function actionLoadJsonModel($id)
    {
        echo Response::getResponseData($id);
    }

}