<?php


function attributesToAssoc($model, $mapRelated) {
    $mapped = $model->getAttributes();
    if ($mapRelated) {
        foreach ($mapRelated as $key=>$item) {
            $path = preg_split('/\./', $item);
            $id = $mapped[$key];
            $mapped[$key] = [$path[1] => $model[$path[0]][$path[1]], $key => $id];
        }
    }
    foreach ($model->relations() as $relation=>$relationProperties) {
        if ($model->hasRelated($relation)) {
            /* ternary operator for old records which is't connected with any company */
            $mapped[$relation] = $model->$relation ? $model->$relation->getAttributes() : null;
        }
    }
    return array_filter($mapped);

}

class AccountancyHelper {


    public static function toAssocArray($dataArray, $mapRelated = null) {
        $result = [];
        if (is_array($dataArray)) {
            foreach ($dataArray as $userAgreement) {
                array_push($result, attributesToAssoc($userAgreement, $mapRelated));
            }
        } else if ($dataArray instanceof CActiveRecord) {
            return attributesToAssoc($dataArray, $mapRelated);
        }
        return $result;
    }

    public static function getTypeahead($value, $className, $fields, $limit=10) {
        if (class_exists($className) && is_subclass_of($className, 'CActiveRecord')) {
            $criteria = new CDbCriteria(['limit' => $limit]);
            foreach ($fields as $field) {
                $criteria->addSearchCondition($field, $value, true, 'OR');
            }
            $models = $className::model()->findAll($criteria);
            return $models;
        }
        return [];
    }
    
}