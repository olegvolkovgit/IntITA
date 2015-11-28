<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 20.10.2015
 * Time: 14:04
 */

class UserHelper {

    public static function getLink($link,$name)
    {
        if($link)
            return "<span class='networkLink'>"."<a href='$link' target='_blank'>"."$name"."</a>"."</span>";
    }

    public static function getUserData($data,$tProfile)
    {
        if($data)
        {
            return  '<span class="colorP">'.Yii::t('profile', $tProfile).'</span>'.$data;
        }
    }

    public static function getNetwork ($post)
    {
        if ($post->facebook || $post->googleplus || $post->linkedin || $post->vkontakte || $post->twitter)
            return  '<span class="colorP">'.Yii::t('user','0779').'</span>';
    }
}