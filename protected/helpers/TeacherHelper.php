<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.06.2015
 * Time: 18:15
 */


class TeacherHelper
{
    public static function getCoursesByTeacher($id){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'params' => array(':id' => $id),
        ))->queryAll();
        $count = count($modules);
        $courses = [];
        for($i = 0;$i < $count;$i++){
            $courseId = Module::model()->findByPk($modules[$i])->course;
            $courses[$courseId] = Course::model()->findByPk($courseId)->course_name;
        }
        return (!empty($courses))?$courses:[];
    }
}