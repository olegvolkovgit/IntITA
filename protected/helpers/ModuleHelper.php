<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.05.2015
 * Time: 1:54
 */

class ModuleHelper {

    public static function getDiscountedPrice($price, $discount){
        if ($discount == 0){
            return $price;
        }
        return round($price*(1-$discount/100));
    }

    public static function getTeacherModules($teacher, $modules){
        $result = [];
        for($i = 0; $i < count($modules); $i++){
            if ($id = TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
                ':teacher' => $teacher,
                ':module' => $modules[$i],
            ))){
                array_push($result, $modules[$i]);
            }
        }
        return $result;
    }

    public static function getModuleName($id){
        return Module::model()->findByPk($id)->module_name;
    }

    public static function getModuleOrder($id){
        return Module::model()->findByPk($id)->order;
    }
    public static function getModuleDuration($countless,$hours,$hInDay,$daysInWeek){
        if ($countless == 0){
            return ;
        }
        return ", ".Yii::t('module', '0217')." - <b>".ceil($hours/($hInDay*$daysInWeek))." ".Yii::t('module', '0218')."</b> (".$hInDay." ".Yii::t('module', '0219').", ".$daysInWeek." ".Yii::t('module', '0220').")";
    }
    public static function getModulePrice($price){
        if ($price == 0){
            return '<span class="colorGreen">Безкоштовно<span>';
        }
        return '<span id="oldPrice">'.$price.' '.Yii::t('module', '0222').'</span> '.ModuleHelper::getDiscountedPrice($price, 50).Yii::t('module', '0222').'('.Yii::t('module', '0223').')';
    }
}