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

    public static function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
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
    public static function isLectureFinished($idUser, $idLecture){
        $passedPages = LecturePage::getFinishedPages($idLecture, $idUser);
        $passedLecture=LectureHelper::isPassedLecture($passedPages);

        return $passedLecture;
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
        $titleParam = LectureHelper::getTypeTitleParam();
        $title = Lecture::model()->findByPk($id)->$titleParam;
        if ($title == ''){
            return Lecture::model()->findByPk($id)->title_ua;
        } else{
            return $title;
        }
    }

    public static function getLectureRate($id)
    {
        return Lecture::model()->findByPk($id)->rate;
    }

    public static function getPreId($order, $idModule){
        return Lecture::model()->findByAttributes(array('order'=>$order-1,'idModule'=>$idModule))->id;
    }
    /* ������ �� ������� �� ������������� � �����, ������� �� �������� ����������� ������ � ���������
   ���������� ����� ������� ������� �� �� ������ ���������� ����� �� �������� */
    public static function getLastEnabledLessonOrder($idModule){
        $user = Yii::app()->user->getId();

        $criteria = new CDbCriteria();
        $criteria->alias='lectures';
        $criteria->addCondition('idModule='.$idModule.' and `order`>0');
        $criteria->order = '`order` ASC';
        $sortedLectures = Lecture::model()->findAll($criteria);

        $lecturesCount=count($sortedLectures);
        foreach($sortedLectures as $lecture){
            if(!LectureHelper::isLectureFinished($user, $lecture->id)){
                return $lecture->order;
            }
        }
        return $lecturesCount;
    }
    public static function getLanguage(){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        return $lang;
    }

    public static function getLecturePageVideo($idLecturePage){
        $lectureElement = LecturePage::model()->findByPk($idLecturePage)->video;
        $videoLink = str_replace("watch?v=", "embed/", LectureElement::model()->findByPk($lectureElement)->html_block);
        return $videoLink;
    }

    public static function getQuizType($id){
        return LectureElement::model()->findByPk($id)->id_type;
    }

    public static function getPageVideoUrl($pageId){
        $element = LecturePage::model()->findByPk($pageId)->video;
        if ($element) {
            return LectureElement::model()->findByPk($element)->html_block;
        }else{
            return '';
        }
    }

    public static function getPageQuiz($pageId){
        $element = LecturePage::model()->findByPk($pageId)->quiz;
        if ($element) {
            return LectureElement::model()->findByPk($element);
        }else{
            return '';
        }
    }

    public static function getNumberLecturePages($idLecture){
        return LecturePage::model()->count('id_lecture=:id', array(':id' => $idLecture));
    }

    public static function getPagesList($idLecture){
        $criteria = new CDbCriteria();
        $criteria->select = 'page_title, page_order';
        $criteria->addCondition('id_lecture='.$idLecture);
        $criteria->order = 'page_order ASC';
        $list = LecturePage::model()->findAll($criteria);
        return $list;
    }

    public static function getModuleByLecture($idLecture){
        return Lecture::model()->findByPk($idLecture)->idModule;
    }

    public static function isLectureFree($id){
        return Lecture::model()->findByPk($id)->isFree;
    }
    /*Assign class press pages if there are at*/
    public static function lastAccessPage($passedPages){
        for ($i = 0, $count = count($passedPages); $i < $count; $i++) {
            if($i == $count-1 && $passedPages[$i]['isDone'])
                return $i;
            if($passedPages[$i]['isDone'] && !$passedPages[$i+1]['isDone'])
                return $i;
        }
            return 0;
    }

    public static function isPassedLecture($passedPages){
        for ($i = 0, $count = count($passedPages); $i < $count; $i++) {
            if (!$passedPages[$i]['isDone']) return false;
        }
        return true;
    }

}