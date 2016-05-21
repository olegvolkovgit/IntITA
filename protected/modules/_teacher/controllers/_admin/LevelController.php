<?php

class LevelController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAdmin();
    }

    public function actionIndex()
    {
        $levels = Level::model()->findAll();

        $this->renderPartial('index',array(
            'levels' => $levels,
        ),false,true);
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

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}