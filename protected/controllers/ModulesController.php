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

    public function actionList()
    {
        if(Yii::app()->user->isGuest) {
            $canEdit = false;
        } else {
            $canEdit = Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isContentManager();
        }

        $this->render('modulesList', array(
            'canEdit' => $canEdit,
        ));
    }

    public function actionGetModulesList()
    {
        echo Module::modulesList();
    }

    public function actionCreate()
    {
        $model = new Module;

        $titleUa = Yii::app()->request->getPost('titleUA', '');
        $titleRu = Yii::app()->request->getPost('titleRU', '');
        $titleEn = Yii::app()->request->getPost('titleEN', '');
        $lang = Yii::app()->request->getPost('language');
        
        $model->language = $lang;
        $model->title_ua = $titleUa;
        $model->title_ru = $titleRu;
        $model->title_en = $titleEn;
        $model->level = 3;

        if ($model->save()) {
            if(!file_exists(Yii::app()->basePath . "/../content/module_".$model->module_ID)){
                mkdir(Yii::app()->basePath . "/../content/module_".$model->module_ID);
            }
            Module::model()->updateByPk($model->module_ID, array('module_img' => 'module.png'));
        } else {
            throw new \application\components\Exceptions\IntItaException(400, 'Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.');
        }
        
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}