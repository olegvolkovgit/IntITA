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
        if(TeacherHelper::isUserTeacher($response->about)){
            $teacher = Teacher::model()->findByAttributes(array('user_id'=>$response->about));
            $teacher->updateByPk($teacher->teacher_id, array('rate_knowledge' => $teacher->getAverageRateKnwl($response->about)));
            $teacher->updateByPk($teacher->teacher_id, array('rate_efficiency' => $teacher->getAverageRateBeh($response->about)));
            $teacher->updateByPk($teacher->teacher_id, array('rate_relations' => $teacher->getAverageRateMot($response->about)));
            $teacher->updateByPk($teacher->teacher_id, array('rating' => $teacher->getAverageRate($response->about)));
        }
    }

    public static function getResponseAboutTeacherName($idUser){
        if (TeacherHelper::getTeacherId($idUser) != 0) {
           return TeacherHelper::getTeacherNameByUserId($idUser);
        } else {
            return 'викладача видалено';
        }
    }
}