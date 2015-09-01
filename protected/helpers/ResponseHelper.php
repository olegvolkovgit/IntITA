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
}