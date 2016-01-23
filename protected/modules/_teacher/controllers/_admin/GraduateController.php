<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.12.2015
 * Time: 14:09
 */

class GraduateController extends TeacherCabinetController {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id)
        ),false,true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Graduate;
        // Uncomment the following line if AJAX validation is needed
//         $this->performAjaxValidation($model);
        if (isset($_POST['Graduate'])) {
            $model->attributes = $_POST['Graduate'];
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');

            if ($model->save()) {
                if (!empty($model->avatar)) {
                    $path = Yii::getPathOfAlias('webroot') . '/images/graduates/' . $model->avatar->getName();
                    $model->avatar->saveAs($path);
                } else {
                    $model->updateByPk($model->id, array('avatar' => 'noname2.png'));
                }
                $this->redirect($this->pathToCabinet());
            }
        }
        $this->renderPartial('create', array(
            'model' => $model,
        ),false,true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
//         $this->performAjaxValidation($model);

        if (isset($_POST['Graduate'])) {
            $avatarOld = $model->avatar;
            $model->attributes = $_POST['Graduate'];
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');

            if ($model->save()) {
                if (!empty($model->avatar)) {
                    $path = Yii::getPathOfAlias('webroot') . '/images/graduates/' . $model->avatar->getName();
                    $model->avatar->saveAs($path);
                } else {
                    if ($avatarOld != null) {
                        $model->updateByPk($model->id, array('avatar' => $avatarOld));
                    } else {
                        $model->updateByPk($model->id, array('avatar' => 'noname2.png'));
                    }
                }
                $this->redirect($this->pathToCabinet());
            }
        }
        $this->renderPartial('update', array(
            'model' => $model
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
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        $this->actionIndex();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Graduate('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Graduate']))
            $model->attributes = $_GET['Graduate'];
        $dataProvider = new CActiveDataProvider('Graduate');
        $this->renderPartial('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ), false, true);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Graduate('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Graduate']))
            $model->attributes = $_GET['Graduate'];
        $this->renderPartial('admin', array(
            'model' => $model
        ),false,true);
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
        $model = Graduate::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDeletePhoto(){
        $id = Yii::app()->request->getPost('id', '0');
        if($id != 0){
            echo Graduate::model()->updateByPk($id, array('avatar' => 'noname2.png'));
        }
        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '/_admin/graduate/'.$id);
    }
    /**
     * Performs the AJAX validation.
     * @param Graduate $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'graduate-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}