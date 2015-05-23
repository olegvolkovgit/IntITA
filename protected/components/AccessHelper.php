<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.05.2015
 * Time: 14:35
 */

class AccessHelper
{

    public static function getFlag($rights, $type)
    {
        $result = false;
        switch ($type) {
            case 'read':
                if ($rights &= 1 << 0)
                    $result = true;
                break;
            case 'edit':
                if ($rights &= 1 << 1)
                    $result = true;
                break;
            case 'create':
                if ($rights &= 1 << 2)
                    $result = true;
                break;
            case 'delete':
                if ($rights &= 1 << 3)
                    $result = true;
                break;
        }
        return ($result)?'+':'';
    }

    public static function getUserName($id){
        $first = StudentReg::model()->findByPk($id)->firstName;
        $second = StudentReg::model()->findByPk($id)->secondName;
        return $first." ".$second;
    }

    public static function getRole($id){
        $code = StudentReg::model()->findByPk($id)->role;
        $role = '';
        switch ($code){
            case '0':
                $role = 'студент';
                break;
            case '1':
                $role = 'викладач';
                break;
            case '2':
                $role = 'модератор';
                break;
            case '3':
                $role = 'адмін';
                break;

        }
        return $role;
    }

    public static function getResourceDescription($id){
        $lecture = "Lecture ".Lecture::model()->findByPk($id)->order.". ".Lecture::model()->findByPk($id)->title;
        $idModule = Lecture::model()->findByPk($id)->idModule;
        $module = "Module"." ".$idModule.". ";
        $idCourse = Module::model()->findByPk($idModule)->course;
        $course = Course::model()->findByPk($idCourse)->course_name.". ";
        return $course.$module.$lecture;
    }
}
