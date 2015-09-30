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
        return round($price*(1-$discount/100),2);
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
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';

        $title = "title_".$lang;
        $moduleTitle = Module::model()->findByPk($id)->$title;
        if ($moduleTitle == ""){
            $moduleTitle = Module::model()->findByPk($id)->title_ua;
        }
        return $moduleTitle;
    }

    public static function getModuleOrder($id){
        return Module::model()->findByPk($id)->order;
    }
    public static function getModuleDuration($countless,$hours,$hInDay,$daysInWeek){
        if ($countless == 0){
            return 0;
        }
        return ", ".Yii::t('module', '0217')." - <b>".ceil($hours/($hInDay*$daysInWeek))." ".Yii::t('module', '0218')."</b> (".$hInDay." ".Yii::t('module', '0219').", ".$daysInWeek." ".Yii::t('module', '0220').")";
    }
    public static function getModulePrice($price, $isCourse){
        if ($price == 0){
            return '<span class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        $result = '<span id="oldPrice">'.$price.' '.Yii::t('module', '0222').'</span> '.ModuleHelper::getDiscountedPrice($price, 50).Yii::t('module', '0222');
        if($isCourse){
            return $result.'('.Yii::t('module', '0223').')';
        } else {
            return $result;
        }
    }

    public static function getModuleTitleParam(){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        $title = "title_".$lang;
        return $title;
    }
    public static function getDefaultModuleName($moduleName){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        $title = "title_".$lang;

        if ($moduleName == "")
            return 'title_ua';
        else return $title;
    }
    public static function getCourseOfModule($moduleId){
        if (CourseModules::model()->exists('id_module=:id', array(':id' => $moduleId))){
            $courseId = CourseModules::model()->find('id_module ='.$moduleId)->id_course;
            return $courseId;
        } else{
            return false;
        }
    }

    public static function getModuleLang($idModule){
        return Module::model()->findByPk($idModule)->language;
    }

    public static function getModuleNumber($idModule){
        return Module::model()->findByPk($idModule)->module_number;
    }

    public static function getPriceUah($summa){
        return round($summa * CommonHelper::getDollarExchangeRate(), 2);
    }
}