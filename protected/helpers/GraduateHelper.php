<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 17.09.2015
 * Time: 16:56
 */

class GraduateHelper {

    public static function getGraduateName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en'  && Graduate::model()->findByPk($id)->last_name_en != ''
                && Graduate::model()->findByPk($id)->last_name_en != ''){
                return Graduate::model()->findByPk($id)->last_name_en."&nbsp;".Graduate::model()->findByPk($id)->first_name_en;
            }
        }
        return Graduate::model()->findByPk($id)->last_name."&nbsp;".Graduate::model()->findByPk($id)->first_name;
    }

}