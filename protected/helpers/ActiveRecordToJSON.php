<?php

/**
 * @param CActiveRecord  $model
 * @param array $mapRelated
 * @return array
 */
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
            $mapped[$relation] = ActiveRecordToJSON::toAssocArray($model->$relation);
        }
    }
    return array_filter($mapped);
}

class ActiveRecordToJSON {

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

    public static function toAssocArrayWithRelations($models) {
        if (is_array($models))
            $arrayMode = TRUE;
        else {
            $models = array($models);
            $arrayMode = FALSE;
        }

        $result = array();
        foreach ($models as $key=>$model) {
            if($model){
                $attributes = $model->getAttributes();
                $relations = array();
                foreach ($model->relations() as $key => $related) {
                    if ($model->hasRelated($key)) {
                        $relations[$key] = ActiveRecordToJSON::toAssocArrayWithRelations($model->$key);
                    }
                }
                $all = array_merge($attributes, $relations);

                if ($arrayMode)
                    array_push($result, $all);
                else
                    $result = $all;
            }
        }
        return $result;
    }
}