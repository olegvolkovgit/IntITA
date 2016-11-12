<?php

class NgTableProviderStudentReg extends NgTableProviderDefault implements INgTableProvider{

    private $relationAttributes = ['firstName', 'middleName', 'secondName', 'email', 'phone'];

    public function getAttributes() {
        return parent::getAttributes();
    }

    public function getRelationAttributes() {
        return $this->relationAttributes;
    }

    public function getSearchCriteria($fieldName, $value, $alias='t') {
        if (!$alias) {
            $alias = 't';
        }

        $criteria = new CDbCriteria();

        if ($fieldName == 'fullName') {
            $criteria->addSearchCondition($this->getColumn($alias, "firstName"), $value, true, 'OR');
            $criteria->addSearchCondition($this->getColumn($alias, "middleName"), $value, true, 'OR');
            $criteria->addSearchCondition($this->getColumn($alias, "secondName"), $value, true, 'OR');
            $criteria->addSearchCondition($this->getColumn($alias, "email"), $value, true, 'OR');
            return $criteria;
        } else {
            return parent::getSearchCriteria($fieldName, $value, $alias);
        }

    }

    public function getOrderStatement($fieldName, $direction, $alias = 't') {
        if (!$alias) {
            $alias = 't';
        }
        if ($fieldName == 'fullName') {
            return [
                "$alias.firstName $direction",
                "$alias.middleName $direction",
                "$alias.secondName $direction"
            ];
        } else {
            return parent::getOrderStatement($fieldName, $direction, $alias);
        }
    }

    public function getAdditionalFields() {
        return ['fullName'];
    }
}