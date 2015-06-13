<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.06.2015
 * Time: 18:15
 */


class TeacherHelper
{
    public static function getModulesByTeacher($id){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'order' => 'idModule',
            'params' => array(':id' => $id),
        ))->queryAll();
        $count = count($modules);

        for($i = 0;$i < $count;$i++){
             $modules[$i]["title"] = Module::model()->findByPk($modules[$i]["idModule"])->module_name;
        }

        return (!empty($modules))?$modules:[];
    }
}