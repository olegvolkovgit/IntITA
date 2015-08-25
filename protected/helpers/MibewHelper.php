<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.07.2015
 * Time: 15:35
 */

class MibewHelper {

    public static function getNameEmail(){
        if (Yii::app()->user->isGuest) {
            $nameEmail='';
        }else {
            $user = StudentReg::model()->findByPk(Yii::app()->user->id);
            $nameEmail='&name='.$user->firstName.'&email='.$user->email;
        }
        return $nameEmail;
    }
    public static function getLg(){
        if (Yii::app()->session['lg']) {
            $lg=Yii::app()->session['lg'];
        }else {
            $lg='ua';
        }
        return $lg;
    }

    public static function getMibewHost(){
        return Yii::app()->params['baseUrl'];
    }

    public static function getMibewHostWithoutHeader(){
        return Yii::app()->params['baseUrlWithoutHeader'];
    }
}