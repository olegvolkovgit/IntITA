<?php

class TemplateController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAuditor();
    }

    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
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