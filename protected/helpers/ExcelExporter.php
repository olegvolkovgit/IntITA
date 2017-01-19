<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 21.12.2016
 * Time: 12:47
 */
class ExcelExporter extends PHPExcel
{

    private $model;
    private $relations = [];
    private $criteria;
    private $fields;
    private $fieldNames = [];
    public function __construct($model,$fields)
    {
        $this->model = $model;
        $this->fields = array_keys($fields);
        $this->fieldNames = array_values($fields);
        foreach ($this->fields as $field){
            $relation = explode('.',$field);
            if (count($relation)>1){
                array_push($this->relations,$relation[0]);

            }
        }
        parent::__construct();
    }

    public function setCriteria($criteria){
        $this->criteria = $criteria;
    }

    public function getDocument(){
        $fieldValues = $this->getData();
        $this->getActiveSheet()
            ->fromArray($this->fieldNames, NULL, 'A1')
            ->fromArray($fieldValues, NULL, 'A2');
        foreach (range(0, count($this->fieldNames)) as $col) {
            $this->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
        }
       return $this;

    }

    private function getData(){
        $data = [];
        $models = $this->getModels();
        foreach ($models as $model){
            $attributes = [];
            foreach ($this->fields as $field){
                $isRelationField = explode('.',$field);
                if (count($isRelationField)>1){
                    if(isset($model->$isRelationField[0]->$isRelationField[1])){
                        array_push($attributes,$model->$isRelationField[0]->$isRelationField[1]);
                    }
                    else
                        array_push($attributes,' ');
                }
                else
                    array_push($attributes,$model->$field);
            }
            array_push($data,$attributes);
        }
        return $data;
    }

    private function getModels(){
        $model = $this->model;
        $models = [];
        if (class_exists($this->model) && is_subclass_of($this->model, 'CActiveRecord')) {
            $models = $model::model()->with(array_unique($this->relations))->findAll($this->criteria);
        };
        return $models;
    }
}