<?php

class TranslateController extends TeacherCabinetController{

    public function actionIndex()
    {
        $model=new Translate('search');
        $model->unsetAttributes();
        if(isset($_GET['Translate']))
            $model->attributes=$_GET['Translate'];

        $this->renderPartial('/translate/index',array(
            'model' => $model,
        ));
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
                throw new CHttpException(403,
                    'Запис з таким id вже є в базі даних. Id повідомлення не може повторюватися.');
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
            $this->actionIndex();
        } else {

            $this->render('create', array(
                'model' => $model,
            ));
        }
    }
}