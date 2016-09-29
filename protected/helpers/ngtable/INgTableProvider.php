<?php

interface INgTableProvider extends IBehavior{
    /**
     * Returns list of fields which should be returned if model is main model in request
     * @return mixed
     */
    public function getAttributes();

    /**
     * Return list of fields which should be returned if model calls as relative model
     * @return mixed
     */
    public function getRelationAttributes();

    /**
     * Returns search ('like') criteria for $fieldName
     * @param string $fieldName field name
     * @param mixed $value field value
     * @param string $alias alias for table. using for related models
     * @return mixed
     */
    public function getSearchCriteria($fieldName, $value, $alias='t');

    /**
     * Returns order statement for $fieldName
     * @param $fieldName
     * @param $direction
     * @param string $alias
     * @return mixed
     */
    public function getOrderStatement($fieldName, $direction, $alias='t');

    /**
     * Returns list of object properties which is not in model attributes and should be attached to response
     * @return mixed
     */
    public function getAdditionalFields();

    /**
     * Returns array of relations name to be loaded
     * @return array
     */
    public function getRelations();
}