<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 11.10.16
 * Time: 20:45
 */
class TypeAheadHelper {
    public static function getTypeahead($value, $className, $fields, $limit=10) {
        if (class_exists($className) && is_subclass_of($className, 'CActiveRecord')) {
            $criteria = new CDbCriteria(['limit' => $limit]);
            foreach ($fields as $field) {
                $criteria->addSearchCondition('LOWER('.$field.')', mb_strtolower($value , 'UTF-8'), true, 'OR');
            }
            $models = $className::model()->findAll($criteria);
            return $models;
        }
        return [];
    }
}