<?php

class TranslateController extends TeacherCabinetController{

    public function hasRole(){
        return Yii::app()->user->model->isSuperAdmin();
    }

    public function actionIndex()
    {
        $model=new Translate('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Translate']))
            $model->attributes=$_GET['Translate'];

        $this->renderPartial('index',array(
            'model'=>$model,
        ),false,true);

    }

    public function actionCreate()
    {
        $model = new Translate();

        $idMessage = Yii::app()->request->getPost('id', '');
        $category = Yii::app()->request->getPost('category', '');
        $translateUa = Yii::app()->request->getPost('translateUa', '');
        $translateRu = Yii::app()->request->getPost('translateRu', '');
        $translateEn = Yii::app()->request->getPost('translateEn', '');
        $comment = Yii::app()->request->getPost('comment', '');

            if(isset($_POST['category']))
        {
            if(Sourcemessages::model()->exists('id=:id', array(':id' => $idMessage))){
                echo 'Запис з таким id вже є в базі даних. Id повідомлення не може повторюватися.';
                Yii::app()->end();
            }
            //add source message
            $result = Sourcemessages::addSourceMessage($idMessage, $category, str_pad("".$idMessage, 4, 0, STR_PAD_LEFT));
            // if added source message, then add translations
            if($result){
                Translate::addNewRecord($idMessage, 'ua', $translateUa);
                Translate::addNewRecord($idMessage, 'ru', $translateRu);
                Translate::addNewRecord($idMessage, 'en', $translateEn);

                MessageComment::addMessageCodeComment($idMessage, $comment);
            }
        } else {

            $this->renderPartial('create', array(
                'model' => $model,
            ),false,true);
        }
    }

    protected function performAjaxValidation($model)
    {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'translate-grid') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionView($id)
    {
        $this->renderPartial('view',array(
            'model'=>$this->loadModel($id),
        ),false,true);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id)->with('source');

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['Translate']))
        {
            $model->attributes=$_POST['Translate'];
            if($model->save()) {
                MessageComment::updateMessageCodeComment($_POST['Translate']['id'], $_POST['Translate']['comment']);
                Yii::app()->cache->flush();
                $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/').'#/interfacemessages');
            }
        }

        $this->renderPartial('update',array(
            'model'=>$model,
        ),false,true);
    }

    public function loadModel($id)
    {
        $model=Translate::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionGetTranslatesList() {
        $params= $_GET;
        $adapter = new NgTableAdapter('Translate',$params);
        $adapter->getData();
        echo json_encode($adapter->getData());
    }

}