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
    public static function getUserName($dp)
    {

        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>Yii::app()->user->id));

        if($teacher){
            $result=StudentReg::model()->findByPk($dp->user_id)->firstName." ".StudentReg::model()->findByPk($dp->user_id)->secondName;
            if($result==' ')
                $result=StudentReg::model()->findByPk($dp->user_id)->email;
        }
        else
            $result=Teacher::model()->findByPk($dp->teacher_id)->first_name." ".Teacher::model()->findByPk($dp->teacher_id)->last_name;

        return $result;
    }
    public static function getTheme($dp)
    {
        $result=Lecture::model()->findByPk($dp->lecture_id)->title;
        return $result;
    }

}
