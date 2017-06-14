<?php

class TypeAheadHelper {
    public static function getTypeahead($value, $className, $fields, $limit=10, $organization=false) {
        if (class_exists($className) && is_subclass_of($className, 'CActiveRecord')) {
            $criteria = new CDbCriteria(['limit' => $limit]);
            foreach ($fields as $field) {
                $criteria->addSearchCondition('LOWER('.$field.')', mb_strtolower($value , 'UTF-8'), true, 'OR');
            }
            if($organization){
                $organization = Yii::app()->user->model->getCurrentOrganization();
                $models = $className::model()->belongsToOrganization($organization)->findAll($criteria);
            }else{
                $models = $className::model()->findAll($criteria);
            }

            return $models;
        }
        return [];
    }
}