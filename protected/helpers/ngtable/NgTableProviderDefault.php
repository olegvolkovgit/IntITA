<?php

class NgTableProviderDefault extends CActiveRecordBehavior implements INgTableProvider{

    public function getAttributes() {
        return array_keys($this->owner->getAttributes());
    }

    public function getRelationAttributes() {
        return array_keys($this->owner->getAttributes());
    }

    public function getSearchCriteria($fieldName, $value, $alias='t') {
        if ($alias === null) {
            $alias = 't';
        }
        $criteria = new CDbCriteria();

        $criteria->addSearchCondition("$alias.$fieldName", $value);
        return $criteria;
    }

    protected function getColumn($alias, $column) {
        return implode('.', array_filter([$alias, $column]));
    }

    public function getOrderStatement($fieldName, $direction, $alias = 't') {
        if ($alias === null) {
            $alias = 't';
        }
        return ["$alias.$fieldName $direction"];
    }
    
    public function getAdditionalFields() {
        return [];
    }

    /**
     * Returns array of relations name to be loaded
     * @return array
     */
    public function getRelations() {
        return $this->owner->relations();
    }
}