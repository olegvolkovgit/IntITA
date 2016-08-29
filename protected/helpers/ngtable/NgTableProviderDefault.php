<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 28.08.16
 * Time: 22:53
 */
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
        if ($alias) {
            $criteria->alias = $alias;
        }
        $criteria->addSearchCondition($fieldName, $value);
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
}