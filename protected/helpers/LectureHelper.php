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

    public static function isLectureAvailable($idUser, $idLecture, $defaultForNoExist){
        $finalTask = LectureHelper::getFinalLectureTask($idLecture);
        if ($finalTask != 0) {
            $typeFinalTask = LectureElement::model()->findByPk($finalTask)->id_type;
            $result = false;
            switch ($typeFinalTask) {
                case '6':
                    $idTask = Task::model()->findByAttributes(array('condition' => $finalTask))->id;
                    $result = TaskMarks::isTaskDone($idUser, $idTask);
                    break;
                case '13':
                    $idTest = Tests::model()->findByAttributes(array('block_element' => $finalTask))->id;
                    $result = TestsMarks::isTestDone($idUser, $idTest);
                    break;
                default:
                    break;
            }
            return $result;
        } else{
            return $defaultForNoExist;
        }
    }

    public static function getFinalLectureTask($idLecture){
        $finalTask = 0;
        if (LectureElement::model()->exists('(id_type = 6 or id_type = 13) and id_lecture=:id_lecture', array(':id_lecture' => $idLecture))){
            $criteria = new CDbCriteria();
            $criteria->addCondition('(id_type=6 or id_type=13) and id_lecture='.$idLecture);
            $criteria->limit = 1;
            $criteria->order = 'block_order';

            $finalTask = LectureElement::model()->find($criteria);

            return $finalTask->id_block;
        }else{
            return 0;
        }

    }

    public static function isFinalFirst($idLecture){
        $count = LectureElement::model()->exists('id_lecture=:id_lecture and (id_type=6 or id_type=13)', array('id_lecture' => $idLecture));
        if ($count){
            return 0;
        }else{
            return 1;
        }
    }

    public static function getLectureTypeTitle($idType){
        if(LectureType::model()->exists('id=:idType', array(':idType' => $idType))){
            $titleParam = LectureHelper::getTypeTitleParam();
            return LectureType::model()->findByPk($idType)->$titleParam;
        }else {
            return '';
        }
    }

    public static function getTypeTitleParam(){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        $title = "title_".$lang;
        return $title;
    }

    public static function getNextId($id){
        $current = Lecture::model()->findByPk($id);
        return Lecture::model()->findByAttributes(array('order'=>$current->order+1,'idModule'=>$current->idModule))->id;
    }

    public  static function getLectureDuration($id)
    {
        return Lecture::model()->findByPk($id)->durationInMinutes.Yii::t('lecture','0076');
    }

    public static function getLectureTitle($id)
    {
        return Lecture::model()->findByPk($id)->title;
    }

    public static function getLectureRate($id)
    {
        return Lecture::model()->findByPk($id)->rate;
    }

    public static function getPreId($order, $idModule){
        return Lecture::model()->findByAttributes(array('order'=>$order-1,'idModule'=>$idModule))->id;
    }
}