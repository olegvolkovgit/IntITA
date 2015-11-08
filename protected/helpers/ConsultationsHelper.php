<?php

class ConsultationsHelper
{
    public static function getUserTitle($idUser)
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$idUser));

        if($teacher)
            $result=Yii::t('profile', '0715');
        else
            $result=Yii::t('profile', '0129');

        return $result;
    }
    public static function getUserName($id,$dp)
    {
        if(!StudentReg::model()->exists('id=:user', array(':user' => $dp->user_id))){
            $result=Yii::t('profile', '0716');
            return $result;
        }
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$id));
        if($teacher){
            if(StudentReg::model()->exists('id=:user', array(':user' => $dp->user_id))){
                $result=StudentReg::model()->findByPk($dp->user_id)->firstName." ".StudentReg::model()->findByPk($dp->user_id)->secondName;
                if($result==' ')
                    $result=StudentReg::model()->findByPk($dp->user_id)->email;
            } else {
                $result = TeacherHelper::getTeacherFirstName($dp->teacher_id) . " " . TeacherHelper::getTeacherLastName($dp->teacher_id);
            }
        } else
            $result = TeacherHelper::getTeacherFirstName($dp->teacher_id) . " " . TeacherHelper::getTeacherLastName($dp->teacher_id);

        return $result;
    }

    public static function getTheme($dp)
    {
        if(Lecture::model()->exists('id=:ID', array(':ID'=>$dp->lecture_id)))
            $result=LectureHelper::getLectureTitle($dp->lecture_id);
        else $result=Yii::t('profile', '0717');

        return $result;
    }
}
