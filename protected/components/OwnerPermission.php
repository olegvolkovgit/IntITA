<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 21.03.2017
 * Time: 9:31
 */
class OwnerPermission
{
    /**
     *   Check if current user have owner permission of model
     *  in model you can have property "owner" 
     */ 
    
    public static function isOwner($model){
        if (isset($model->created_by)){
            if($model->created_by == Yii::app()->user->id)
            {
                return true;
            }
            return false;
        }
        else{
            throw new CHttpException(400,'Property not found in model!');
        }

    }

}