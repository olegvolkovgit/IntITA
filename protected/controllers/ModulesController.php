<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.10.2015
 * Time: 2:21
 */

class ModulesController extends Controller{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'cancelled=0';
        $dataProvider = new CActiveDataProvider('Module', array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>50)
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreate()
    {
        $module = new Module;

        $titleUa = Yii::app()->request->getPost('titleUA', '');
        $titleRu = Yii::app()->request->getPost('titleRU', '');
        $titleEn = Yii::app()->request->getPost('titleEN', '');
        $lang = Yii::app()->request->getPost('language');
        $author = Yii::app()->request->getPost('isAuthor', 0);

        $module->language = $lang;
        $module->title_ua = $titleUa;
        $module->title_ru = $titleRu;
        $module->title_en = $titleEn;
        $module->level = 3;

        if ($module->save()) {
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$module->module_ID)){
                mkdir(Yii::app()->basePath . "/../content/module_".$module->module_ID);
            }
            Module::model()->updateByPk($module->module_ID, array('module_img' => 'module.png'));
        } else {
            throw new \application\components\Exceptions\IntItaException(400, 'Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.');
        }

        if($author != 0){
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new MessagesAuthorRequest();
                $model = StudentReg::model()->findByPk($author);
                $message->build($module, $model);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
            } catch (Exception $e){
                $transaction->rollback();
                throw new \application\components\Exceptions\IntItaException(500, "Запит на редагування модуля не вдалося надіслати.");
            }
        }
        
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}