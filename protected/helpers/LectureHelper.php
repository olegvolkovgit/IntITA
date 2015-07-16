<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.07.2015
 * Time: 18:42
 */

class LectureHelper {

    public static function getTaskId($idBlock){
        //if (Task::model()->exists('condition=:idBlock', array(':idBlock' => $idBlock))){
        $assignment = Task::model()->findByAttributes(array('condition' => $idBlock))->assignment;
            return ($assignment)?$assignment:false;
//        } else {
//            return false;
//        }
    }

    public static function getTaskLang($idBlock){
        $assignment = Task::model()->findByAttributes(array('condition' => $idBlock))->language;
        return ($assignment)?$assignment:false;
    }
}