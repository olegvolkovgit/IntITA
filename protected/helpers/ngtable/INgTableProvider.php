<?php

interface INgTableProvider {
    public function getAttributes();
    public function getRelationAttributes();
    public function getSearchCriteria($fieldName, $value, $alias='t');
    public function getOrderStatement($fieldName, $direction, $alias='t');
}