<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 12.08.2016
 * Time: 10:55
 */
/**
 * Json helper for NgDatatables
 * @records - records from selected model
 * @attributes - model attributes e.g. names of database fields in model
 * @modelRecordsCount - count of records
 * Enjoy
 * PS: Sorry for my English and code :)
 */

class JsonForNgDatatablesHelper extends CActiveRecord
{
    public static function returnJson($records, $attributes=null, $modelRecordsCount=0){
        $result = [];
        ($modelRecordsCount)?$data = ['count'=>$modelRecordsCount]:$data = ['count'=>count($records)];
        foreach ($records as $record) {
           ($record instanceof CActiveRecord)?$result["rows"][] = $record->getAttributes($attributes):$result["rows"][] =$record;
        }
        $t = $result;
        return json_encode(array_merge($data, $result));
    }

}