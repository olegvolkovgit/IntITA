<?php

/**
 * Class NgTableAdapterWithoutFilter
 */
class NgTableAdapterWithoutFilter extends NgTableAdapter {

    /**
     * @param CActiveRecord $model
     * @return array
     */
    public function getModelAssoc($model) {
        $provider = $this->getBehavior($model);
        $result = $model->getAttributes();
        foreach ($provider->getAdditionalFields() as $property) {
            $result[$property] = $model->$property;
        }
        return $result;
    }

}