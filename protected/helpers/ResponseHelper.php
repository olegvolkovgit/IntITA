<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 01.09.2015
 * Time: 16:14
 */

class ResponseHelper {

    public static function getResponseAuthorName($id){
        $model = StudentReg::model()->findByPk($id);
        return $model->firstName." ".$model->secondName.", ".$model->email;
    }

    public static function isPublish($idResponse){
        return (Response::model()->findByPk($idResponse)->is_checked)?'опубліковано':'прихований';
    }

    public static function setTeacherRating($response){
        $teacherId = Yii::app()->db->createCommand()
            ->select('id_teacher')
            ->from('teacher_response')
            ->where('id_response=:id', array(':id'=>$response->id))
            ->queryScalar();

        $responsesIdList = Response::getTeachersResponseId($teacherId);
        Teacher::setAverageTeacherRatings($teacherId, $responsesIdList);
    }

    public static function getResponseAboutTeacherName($idResponse){
        $teacherId = Yii::app()->db->createCommand()
            ->select('id_teacher')
            ->from('teacher_response')
            ->where('id_response=:id', array(':id'=>$idResponse))
            ->queryScalar();

        if ($teacherId) {
           return TeacherHelper::getTeacherNameByUserId($teacherId);
        } else {
            return 'викладача видалено';
        }
    }
}