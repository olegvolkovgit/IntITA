<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.09.2015
 * Time: 23:35
 */

class MainpageHelper {

    public static function getTitle(){
        return Yii::t('mainpage', '0001');
    }

    public static function getSliderHeader(){
        return Yii::t('slider', '0005');
    }

    public static function getHeader1(){
        return Yii::t('mainpage','0002');
    }

    public static function getSubheader1(){
        return Yii::t('mainpage', '0006');
    }

    public static function getSliderButtonText(){
        return Yii::t('slider', '0008');
    }

    public static function getHeader2()
    {
        return Yii::t('mainpage', '0003');
    }

    public static function getSubheader2(){
        return Yii::t('mainpage', '0007');
    }

    public static function getLinkName(){
        return Yii::t('mainpage', '0004');
    }

    public static function getFormHeader1(){
        return Yii::t('regform', '0009');
    }

    public static function getFormHeader2(){
        return Yii::t('regform', '0010');
    }

    public static function getRegText(){
        return Yii::t('regform', '0011');
    }

    public static function getButtonStart(){
        return Yii::t('regform', '0013');
    }

    public static function getSocialText(){
        return Yii::t('regform', '0012');
    }
}