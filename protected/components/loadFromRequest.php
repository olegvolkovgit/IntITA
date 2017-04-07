<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 07.04.2017
 * Time: 14:41
 */
trait loadFromRequest{
    public function loadModel($params){
        foreach ($params as $key=>$value){
            if ($this->hasAttribute($key)){
                if (is_array($value)){
                    $this->$key = serialize($value);
                }
                else{
                    $this->$key = $value;
                }

            }

        }
        if($this->hasAttribute('created_by')) {
            $this->created_by = Yii::app()->user->id;
        }
        if($this->hasAttribute('id_organization')) {
            $this->id_organization = Yii::app()->session['organization'];
        }
        return $this;
    }
}