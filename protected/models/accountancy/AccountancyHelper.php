<?php


function attributesToAssoc($userAgreement, $mapRelated) {
    $mapped = $userAgreement->getAttributes();
    if ($mapRelated) {
        foreach ($mapRelated as $key=>$item) {
            $path = preg_split('/\./', $item);
            $id = $mapped[$key];
            $mapped[$key] = [$path[1] => $userAgreement[$path[0]][$path[1]], $key => $id];
        }
    }
    return $mapped;

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
                $criteria->addSearchCondition($field, $value);
            }
            $models = $className::model()->findAll($criteria);
            return $models;
        }
        return [];
    }
    
}