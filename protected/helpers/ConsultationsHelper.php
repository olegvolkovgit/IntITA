<?php

class ConsultationsHelper
{
    public static function getUserTitle($idUser)
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$idUser));

        if($teacher)
            $result='Студент';
        else
            $result=Yii::t('profile', '0129');

        return $result;
    }
    public static function getUserName($id,$dp)
    {

        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$id));

        if($teacher){
            if(StudentReg::model()->exists('id=:user', array(':user' => $dp->user_id))){
                $result=StudentReg::model()->findByPk($dp->user_id)->firstName." ".StudentReg::model()->findByPk($dp->user_id)->secondName;
                if($result==' ')
                    $result=StudentReg::model()->findByPk($dp->user_id)->email;
            }
        } elseif(Teacher::model()->exists('teacher_id=:teacher', array(':teacher' => $dp->user_id))) {
            $result = Teacher::model()->findByPk($dp->teacher_id)->first_name . " " . Teacher::model()->findByPk($dp->teacher_id)->last_name;
        } else $result='unknown';

        return $result;
    }
    public static function getTheme($dp)
    {
        $result=Lecture::model()->findByPk($dp->lecture_id)->title;
        return $result;
    }

}
