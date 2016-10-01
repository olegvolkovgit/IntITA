<?php

class LevelController extends TeacherCabinetController
{
    public function hasRole(){

        return Yii::app()->user->model->isAdmin() || (Yii::app()->user->model->isContentManager() &&  Yii::app()->controller->action ->id == 'getlevelslist');
    }

    public function actionIndex()
    {
        $levels = Level::model()->findAll();
        $this->renderPartial('index',array(
            'levels' => $levels,
        ),false,true);
    }

    public function actionGetLevelsList($page =0, $pageCount=10){
        $criteria = new CDbCriteria([
            'offset' => $page*$pageCount -$pageCount,
            'limit' => $pageCount
        ]);
        echo JsonForNgDatatablesHelper::returnJson(Level::model()->findAll($criteria),null,Level::model()->count());
    }

    public function actionEdit($id)
    {
        $level = Level::model()->findByPk($id);

        if(!$level){
            throw new \application\components\Exceptions\IntItaException('400');
        }

        $this->renderPartial('edit',array(
            'model' => $level,
        ),false,true);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getPost('id', '');
        $titleUa = Yii::app()->request->getPost('titleUa', '');
        $titleRu = Yii::app()->request->getPost('titleRu', '');
        $titleEn = Yii::app()->request->getPost('titleEn', '');

        $model = Level::model()->findByPk((int)$id);
        $model->edit($titleUa, $titleRu, $titleEn);

        $this->redirect(Yii::app()->createUrl('cabinet/').'#/configuration/levels');
    }
}