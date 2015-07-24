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

    public static function getTaskIcon($user, $idBlock, $editMode){
        if ($editMode || $user == 0){
            return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
        } else {
            $idTask = Task::model()->findByAttributes(array('condition' => $idBlock))->id;
            if (TaskMarks::isTaskDone($user, $idTask)){
                return StaticFilesHelper::createPath('image', 'lecture', 'taskDone.png');
            } else {
                return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
            }
        }
    }

    public static function getTestIcon($user, $idBlock, $editMode){
        if ($editMode || Yii::app()->user->isGuest){
            return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
        } else {
            $idTest = Tests::model()->findByAttributes(array('block_element' => $idBlock))->id;
            if (TestsMarks::isTestDone($user, $idTest)){
                return StaticFilesHelper::createPath('image', 'lecture', 'taskDone.png');
            } else {
                return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
            }
        }
    }
}