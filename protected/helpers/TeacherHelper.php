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

    public static function getTeacherName($id){
        return Teacher::model()->findByPk($id)->last_name." ".Teacher::model()->findByPk($id)->first_name;
    }

    public static function getTeachersRoles($id){
        $roles = Yii::app()->db->createCommand()
            ->select('role')
            ->from('teacher_roles')
            ->where('teacher=:id', array(':id'=>$id))
            ->order('role DESC')
            ->queryAll();
        $result = '';
        for($i = count($roles)-1; $i > 0; $i--){
            $result .= TeacherHelper::getRoleTitle($roles[$i]['role']);
            $result .= "\r\n";
        }
        return $result;
    }

    public static function getRoleTitle($id){
        return Roles::model()->findByPk($id)->title;
    }

    public static function getTeacherAttributeValue($teacher, $attribute){
        return AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute))->value;

    }
}