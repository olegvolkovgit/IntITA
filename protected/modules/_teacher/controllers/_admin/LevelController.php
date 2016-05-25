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

    public function actionOffer()
    {
        $this->renderPartial('offer',array(),false,true);
    }

    public function actionEditOffer($lang){
        $this->renderPartial('_editOffer',array(
            'lang' => $lang
        ),false,true);
    }

    public function actionUpdateOffer(){
        $lang = Yii::app()->request->getPost('lang', '');
        $text = Yii::app()->request->getPost('text', '');

        $url = 'files/offers/offer_' . $lang . '.html';
        if(file_put_contents($url, $text)){
            echo 'Зміни успішно збережено.';
        } else {
            echo 'Зміни не вдалося зберегти.';
        }
    }
}