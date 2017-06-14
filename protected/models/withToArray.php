<?php

/**
 * Trait withToArray
 */
trait withToArray {

    abstract function relations();

    /**
     * @param CActiveRecord $model
     * @param int $depth
     * @return array
     * @throws TypeError
     */
    private function _toArray($model, $depth) {
        $attributes = empty($model) ? $model : $model->getAttributes();
        if (!empty($model) && $depth) {
            $relations = array_keys($model->relations());
            foreach ($relations as $relationName) {
                if ($model->hasRelated($relationName)) {
                    $relatedModel = $model->$relationName;
                    if (is_array($relatedModel)) {
                        $attributes[$relationName] = [];
                        foreach ($relatedModel as $key => $value) {
                            $attributes[$relationName][$key] = $this->_toArray($value, $depth - 1);
                        }
                    } else {
                        $attributes[$relationName] = $this->_toArray($relatedModel, $depth - 1);
                    }
                }
            }
        }
        return $attributes;
    }

    /**
     * Returns associated array of models's attributes
     * including related models attributes
     * Retrieves attributes only from models that has been loaded before.
     *
     * @param int $depth
     * @return array
     */
    public function toArray($depth = PHP_INT_MAX) {
        return $this->_toArray($this, $depth);
    }
}