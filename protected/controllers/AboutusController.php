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
        $mainpage = Mainpage::model()->findByPk(0);
        $arrayAboutUs = $this->initAboutus();
        $this->render('index', array(
            'mainpage'=>array(
                'title'=>$mainpage->title,
                'header1'=>$mainpage->header1,
                'linkName'=>$mainpage->linkName,
                'subLineImage'=>$mainpage->subLineImage,
                'subheader1'=>$mainpage->subheader1,
            ),
            'block1'=>$arrayAboutUs['objAbout1'],
            'block2'=>$arrayAboutUs['objAbout2'],
            'block3'=>$arrayAboutUs['objAbout3'],
        ));
    }

    public function initAboutus(){
        $objAbout1 = new AboutUs(1);
        $objAbout1->setValuesById(1);
        $objAbout1->titleText = Yii::t('aboutus', '0032');
        $objAbout1->textAbout = Yii::t('aboutus', '0035');
        $objAbout2 = new AboutUs(2);
        $objAbout2->setValuesById(2);
        $objAbout2->titleText = Yii::t('aboutus', '0033');
        $objAbout2->textAbout = Yii::t('aboutus', '0036');
        $objAbout3 = new AboutUs(3);
        $objAbout3->setValuesById(3);
        $objAbout3->titleText = Yii::t('aboutus', '0034');
        $objAbout3->textAbout = Yii::t('aboutus', '0037');
        return $arrayAboutUs = array(
            'objAbout1'=>$objAbout1,
            'objAbout2'=>$objAbout2,
            'objAbout3'=>$objAbout3,
        );
    }
}