<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 05.12.2015
 * Time: 1:39
 */

class Footer {

    public function getEmail(){
        return Yii::t('footer', '0025');
    }

    public function getTel(){
        return Yii::t('footer', '0023');
    }

    public function getSkype(){
        return Yii::t('footer', '0026');
    }

    public function getMobile(){
        return Yii::t('footer', '0024');
    }

}