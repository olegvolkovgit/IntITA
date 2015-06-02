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
}