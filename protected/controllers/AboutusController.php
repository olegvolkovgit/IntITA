<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:11
 */

class AboutusController extends Controller{

    public function actionIndex()
    {
        $arrayAboutUs = $this->initAboutus();
        $this->render('index', array(
            'block1'=>$arrayAboutUs['objAbout1'],
            'block2'=>$arrayAboutUs['objAbout2'],
            'block3'=>$arrayAboutUs['objAbout3'],
        ));
    }

    public function initAboutus(){
        $objAbout1 = new AboutUs(1);
        $objAbout1->setValuesById(1);
        $objAbout1->titleText = Yii::t('aboutus', '0032');
        $objAbout1->titleTextExp = Yii::t('aboutus', '0556');
        $objAbout1->textAbout = Yii::t('aboutus', '0035');
        $objAbout2 = new AboutUs(2);
        $objAbout2->setValuesById(2);
        $objAbout2->titleText = Yii::t('aboutus', '0033');
        $objAbout2->titleTextExp = Yii::t('aboutus', '0557');
        $objAbout2->textAbout = Yii::t('aboutus', '0036');
        $objAbout3 = new AboutUs(3);
        $objAbout3->setValuesById(3);
        $objAbout3->titleText = Yii::t('aboutus', '0034');
        $objAbout3->titleTextExp = Yii::t('aboutus', '0558');
        $objAbout3->textAbout = Yii::t('aboutus', '0037');
        return $arrayAboutUs = array(
            'objAbout1'=>$objAbout1,
            'objAbout2'=>$objAbout2,
            'objAbout3'=>$objAbout3,
        );
    }
}