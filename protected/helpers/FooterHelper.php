<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.09.2015
 * Time: 17:07
 */

class FooterHelper {

    public static function getEmail(){
        return Yii::t('footer', '0025');
    }

    public static function getTel(){
        return Yii::t('footer', '0023');
    }

    public static function getSkype(){
        return Yii::t('footer', '0026');
    }

    public static function getMobile(){
        return Yii::t('footer', '0024');
    }

}