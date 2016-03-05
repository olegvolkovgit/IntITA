<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 03.11.2015
 * Time: 15:58
 */

class ForumUser extends CActiveRecord{

    public function getDbConnection() {
        return Yii::app()->dbForum;
    }

    public function tableName(){
        return 'phpbb_users';

    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public static function login($userModel)
    {
        $current_lang = Yii::app()->session['lg'];
        if ($current_lang == "ua") $current_lang = "uk";

        if(!empty($userModel->birthday)){
            $birthday = $userModel->birthday;
            $birthday = str_replace("/", "-", $birthday);
            if($birthday[0] == "0") $birthday[0] = '';
            if($birthday[3] == "0") $birthday[3] = '';
        }else $birthday='';

        $avatar = $userModel->avatar;
        if ($avatar == null || $avatar == "") $avatar = "noname.png";

        ForumUser::logout();

        $forumUser = ForumUser::model()->findByPk($userModel->id);
        if (!$forumUser) {
            $firstName = ($userModel->firstName) ? $userModel->firstName : '';
            $secondName = ($userModel->secondName) ? $userModel->secondName : '';
            $name = $firstName . ' ' . $secondName . $userModel->email;
            if ($name == ' ') $name = $userModel->email;
            $reg_time = $userModel->reg_time;
            if ($reg_time == 0) $reg_time = time();

            $forumUser = new ForumUser();
            $forumUser->user_id = $userModel->id;
            $forumUser->username = $name;
            $forumUser->user_email = $userModel->email;
            $forumUser->username_clean = $name;
            $forumUser->user_timezone = 'Europe/Kiev';
            $forumUser->user_dateformat = 'd M Y H:i';
            $forumUser->user_regdate = $reg_time;
            $forumUser->user_lang = $current_lang;
            $forumUser->user_birthday = $birthday;
            $forumUser->user_avatar = $avatar;
            $forumUser->user_avatar_type = "avatar.driver.upload";

            Yii::app()->dbForum->createCommand()->insert('phpbb_user_group', array(
                'group_id' => 2,
                'user_id' => $userModel->id,
                'group_leader' => 0,
                'user_pending' => 0
            ));
        }

        else {
            $forumUser->user_lang = $current_lang;
            $forumUser->user_birthday = $birthday;
            $forumUser->user_email = $userModel->email;
            $forumUser->user_avatar = $avatar;
            $forumUser->user_avatar_type = "avatar.driver.upload";
        }

        if($forumUser->save())
            return true;
        else
            return false;
    }

    public static function logout()
    {
        Yii::app()->dbForum->createCommand()->delete('phpbb_sessions', 'session_user_id=1');
    }
}