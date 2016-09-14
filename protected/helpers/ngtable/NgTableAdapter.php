<?php

/**
 * Class NgTableAdapter
 */
class NgTableAdapter {

    /**
     *  Default records per page number
     */
    const DEFAULT_COUNT = -1;
    /**
     *  Default page number
     */
    const DEFAULT_PAGE = -1;

    /**
     * @var CActiveRecord
     */
    private $activeRecord = null;
    /**
     * @var array
     */
    private $relations = null;

    /**
     * @var array
     */
    private $requestParams = null;
    /**
     * @var CDbCriteria
     */
    private $criteria = null;
    /**
     * @var int
     */
    private $page = 0;
    /**
     * @var int
     */
    private $count = 10;
    /**
     * @var int
     */
    private $offset = null;
    /**
     * @var int
     */
    private $limit = null;
    /**
     * @var array
     */
    private $filter = null;
    /**
     * @var array
     */
    private $sorting = null;

    private $extraParams = null;

    /**
     * TODO WeekMap ?
     * @var array
     */
    private $attachedBehaviors = [];

    /**
     * NgTableAdapter constructor.
     * @param CActiveRecord|string $activeRecord
     * @param array $requestParams
     * @throws Exception
     */
    public function __construct($activeRecord = null, $requestParams = null) {
        $this->setActiveRecord($activeRecord);
        $this->setRequestParams($requestParams);
    }

    /**
     * @param null|string|CActiveRecord $activeRecord
     * @throws Exception
     */
    public function setActiveRecord($activeRecord) {
        if (isset($activeRecord)) {
            if (gettype($activeRecord) === 'string' &&
                class_exists($activeRecord) &&
                is_subclass_of($activeRecord, 'CActiveRecord')
            ) {
                $this->prepareActiveRecord($activeRecord::model());
            } else if (is_object($activeRecord) &&
                $activeRecord instanceof CActiveRecord
            ) {
                $this->prepareActiveRecord($activeRecord);
            } else {
                throw new Exception('Type error: $activeRecord argument should be either an CActiveRecord object (or inherit CActiveRecord) or string with CActiveRecord (or it inherited) class name ');
            }
        } else {
            $this->activeRecord = null;
        }
    }

    /**
     * @param array $requestParams
     */
    public function setRequestParams($requestParams) {
        /* TODO array_merge */
        $this->requestParams = $requestParams;
        $this->page = key_exists('page', $this->requestParams) ? $this->requestParams['page'] : self::DEFAULT_PAGE;
        $this->count = key_exists('count', $this->requestParams) ? $this->requestParams['count'] : self::DEFAULT_COUNT;
        $this->offset = $this->page * $this->count - $this->count;
        $this->limit = $this->count;
        $this->filter = key_exists('filter', $this->requestParams) ? $this->requestParams['filter'] : [];
        $this->sorting = key_exists('sorting', $this->requestParams) ? $this->requestParams['sorting'] : [];
        $this->extraParams = key_exists('extraParams', $this->requestParams) ? $this->requestParams['extraParams'] : [];

        foreach ($this->filter as $key => $item) {
            $this->filter[$key] = urldecode($item);
        }

        $this->prepareCriteria();
    }

    /**
     * @return array
     */
    public function getData() {
        $models = $this->activeRecord->findAll($this->getCriteriaInstance());
        $totalCount = $this->activeRecord->count($this->getCriteriaInstance());

        return [
            'count' => $totalCount,
            'rows' => $this->toAssocArray($models)
        ];
    }

    /**
     * @param CDbCriteria $criteria
     */
    public function mergeCriteriaWith($criteria) {
        $this->getCriteriaInstance()->mergeWith($criteria);
    }

    private function getModelAssoc($model) {
        $provider = $this->getBehavior($model);

        $result = array_filter($model->getAttributes());
        foreach ($provider->getAdditionalFields() as $property) {
            $result[$property] = $model->$property;
        }
        return $result;
    }

    /**
     * @param CActiveRecord $model
     * @return array
     */
    private function modelToAssoc($model) {
        $result = $this->getModelAssoc($model);

        foreach (array_keys($this->relations) as $relationName) {
            $relation = $model->$relationName;
            if ($relation instanceof CActiveRecord) {
                $result[$relationName] = $this->getModelAssoc($relation);
            } else if (is_array($relation)) {
                $result[$relationName] = [];
                foreach ($relation as $item) {
                    array_push($result[$relationName], $this->getModelAssoc($item));
                }
            }
        }
        return $result;
    }

    /**
     * @param CActiveRecord[] $dataArray
     * @return array
     */
    private function toAssocArray($dataArray) {
        $result = [];
        if (is_array($dataArray)) {
            foreach ($dataArray as $userAgreement) {
                array_push($result, $this->modelToAssoc($userAgreement));
            }
        } else if ($dataArray instanceof CActiveRecord) {
            return $this->modelToAssoc($dataArray);
        }
        return $result;
    }

    /**
     * @param CActiveRecord $ar
     */
    private function prepareActiveRecord($ar) {
        $this->activeRecord = $ar;
        $this->relations = [];

        $provider = $this->getBehavior($this->activeRecord);
        foreach ($provider->getRelations() as $relationName => $relationProperties) {
            $this->relations[$relationName] = $relationProperties[1];
        }
    }

    /**
     *
     */
    private function prepareCriteria() {
        $this
            ->buildSelectQuery()
            ->buildLimitQuery($this->offset, $this->limit)
            ->buildFilterQuery($this->filter)
            ->buildSortingQuery($this->sorting)
            ->buildExtraParamsQuery($this->extraParams)
        ;
    }

    /**
     * @return CDbCriteria|null
     */
    private function getCriteriaInstance() {
        if (!$this->criteria) {
            $this->criteria = new CDbCriteria();
        }
        return $this->criteria;
    }

    /**
     * @return $this
     * @throws Exception
     */
    private function buildSelectQuery() {
        $with = [];
        foreach ($this->relations as $relationName => $className) {
            $select = [];
            $model = $this->getModel($relationName);
            $provider = $this->getBehavior($model);
            foreach ($provider->getRelationAttributes() as $attribute) {
                $select[] = "`$relationName`.`$attribute`";
            }
            $with[$relationName] = ['select' => implode(',', $select), 'joinType' => 'LEFT JOIN'];
        }
        $this->getCriteriaInstance()->with = $with;

        $provider = $this->getBehavior($this->activeRecord);
        $this->getCriteriaInstance()->select = $provider->getAttributes();

        return $this;
    }

    /**
     * @param $offset
     * @param $limit
     * @return $this
     */
    private function buildLimitQuery($offset, $limit) {
        if ($limit > 0) {
            $this->getCriteriaInstance()->offset = $offset;
            $this->getCriteriaInstance()->limit = $limit;
        };
        return $this;
    }

    /**
     * @param $filter
     * @return $this
     * @throws Exception
     */
    private function buildFilterQuery($filter) {
        if ($filter) {
            $criteria = null;
            foreach ($filter as $field => $value) {
                if ($value !== null) {
                    $fields = preg_split('/\./', $field);
                    $fieldName = array_pop($fields);
                    $relation = array_pop($fields);
                    $model = $this->getModel($relation);
                    $ngTableProvider = $this->getBehavior($model);
                    $this->getCriteriaInstance()->mergeWith($ngTableProvider->getSearchCriteria($fieldName, $value, $relation));
                }
            }
        }
        return $this;
    }

    /**
     * @param $sorting
     * @return $this
     * @throws Exception
     */
    private function buildSortingQuery($sorting) {
        $orderStatement = [];
        foreach ($sorting as $field => $order) {
            if ($order !== null) {
                $fields = preg_split('/\./', $field);
                $fieldName = array_pop($fields);
                $relation = array_pop($fields);
                $model = $this->getModel($relation);
                $ngTableProvider = $this->getBehavior($model);
                $orderStatement = array_merge($orderStatement, $ngTableProvider->getOrderStatement($fieldName, $order, $relation));
            }
        }
        $this->getCriteriaInstance()->order = implode(',', $orderStatement);
        return $this;
    }

    private function buildExtraParamsQuery($extraParams) {
        foreach ($extraParams as $field => $value) {
            $this->getCriteriaInstance()->mergeWith(new CDbCriteria([
                'condition' => "t.$field = $value"
            ]));
        }
    }

    /**
     * @param $relation
     * @return null|void
     * @throws Exception
     */
    private function getModel($relation) {
        if (!$relation) {
            return $this->activeRecord;
        } else {
            $modelRelations = $this->activeRecord->relations();
            if (key_exists($relation, $modelRelations)) {
                return $modelRelations[$relation][1]::model();
            } else {
                throw new Exception("Reation $relation doesn't exists in " + get_class($this->activeRecord));
            }
        }
    }

    /**
     * @param $model
     * @return INgTableProvider
     */
    private function getBehavior($model) {
        $ngTableProvider = null;
        if (!isset($model->ngTable)) {
            $model->attachBehavior('ngTable', ['class' => 'NgTableProviderDefault']);
            $this->attachedBehaviors[] = ['model' => $model, 'name' => 'ngTable'];
        }
        $ngTableProvider = $model->ngTable;
        return $ngTableProvider;
    }

    /**
     *
     */
    function __destruct() {
        foreach ($this->attachedBehaviors as $attached) {
            $attached['model']->detachBehavior($attached['name']);
        }
    }

}