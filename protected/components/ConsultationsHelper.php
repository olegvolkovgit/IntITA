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
            $user=StudentReg::model()->findByPk($dp->user_id);
            if($user){
                $result=$user->firstName." ".$user->secondName;
                if($result==' ')
                    $result=$user->email;
            }else $result='unknown';
        }
        else{
            $user=Teacher::model()->findByPk($dp->teacher_id);
            if($user){
                $result=$user->first_name." ".$user->last_name;
                if($result==' ')
                    $result=$user->email;
            }else $result='unknown';
        }
        return $result;
    }
    public static function getTheme($dp)
    {
        $result=Lecture::model()->findByPk($dp->lecture_id)->title;
        return $result;
    }

}
