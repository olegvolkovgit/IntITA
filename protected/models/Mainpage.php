<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.12.2015
 * Time: 1:10
 */

class Mainpage {

    public function getTitle(){
        return Yii::t('mainpage', '0001');
    }

    public function getSliderHeader(){
        return Yii::t('slider', '0005');
    }

    public function getHeader1(){
        return Yii::t('mainpage','0002');
    }

    public function getSubheader1(){
        return Yii::t('mainpage', '0006');
    }

    public function getSliderButtonText(){
        return Yii::t('slider', '0008');
    }

    public function getHeader2()
    {
        return Yii::t('mainpage', '0003');
    }

    public function getSubheader2(){
        return Yii::t('mainpage', '0007');
    }

    public function getLinkName(){
        return Yii::t('mainpage', '0004');
    }

    public function getFormHeader1(){
        return Yii::t('regform', '0009');
    }

    public function getFormHeader2(){
        return Yii::t('regform', '0010');
    }

    public function getRegText(){
        return Yii::t('regform', '0011');
    }

    public function getButtonStart(){
        return Yii::t('regform', '0013');
    }

    public function getSocialText(){
        return Yii::t('regform', '0012');
    }

    public static function getPartnerLink(){
        switch (Yii::app()->session['lg']) {
            case 'ua':
                return 'https://drive.google.com/file/d/1hIGJBTHCkfQMsLWgWhh7yrLcSR4DAlwh/view';
                break;
            case 'ru':
                return 'https://drive.google.com/file/d/1hIGJBTHCkfQMsLWgWhh7yrLcSR4DAlwh/view';
                break;
            case 'en':
                return 'https://drive.google.com/file/d/1YiAXa2TARIMLtA8W6ptuaPdxty4k3MYD/view';
                break;
            default:
                return 'https://drive.google.com/file/d/1hIGJBTHCkfQMsLWgWhh7yrLcSR4DAlwh/view';
                break;
        }
    }
}