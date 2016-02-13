<?php

class ConsultationsHelper
{
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
                $result = Teacher::getTeacherFirstName($dp->teacher_id) . " " .
                    Teacher::getTeacherLastName($dp->teacher_id);
            }
        } else
            $result = Teacher::getTeacherFirstName($dp->teacher_id) . " " .
                Teacher::getTeacherLastName($dp->teacher_id);

        return $result;
    }
}
