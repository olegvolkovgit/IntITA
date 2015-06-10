<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 10.06.2015
 * Time: 17:01
 */

class CourseHelper {
    public static function translateLevel($level){
        switch ($level){
            case 'intern':
                $level = Yii::t('courses', '0232');
                //$rate = 1;
                break;
            case 'junior':
                $level = Yii::t('courses', '0233');
                //$rate = 2;
                break;
            case 'strong junior':
                $level = Yii::t('courses', '0234');
                //$rate = 3;
                break;
            case 'middle':
                $level = Yii::t('courses', '0235');
                //$rate = 4;
                break;
            case 'senior':
                $level = Yii::t('courses', '0236');
                //$rate = 5;
                break;
        }
        return $level;
    }

    public static function getCourseRate($level){
        $rate = 0;
        switch ($level){
            case 'intern':
                $rate = 1;
                break;
            case 'junior':
                $rate = 2;
                break;
            case 'strong junior':
                $rate = 3;
                break;
            case 'middle':
                $rate = 4;
                break;
            case 'senior':
                $rate = 5;
                break;
        }
        return $rate;
    }

}