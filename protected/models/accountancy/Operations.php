<?php

class Operations {

    private $relatedModelsMapping = [
        'type_id' => 'type.description',
        'user_create' => 'userCreated.fullName'
    ];

    public function getOperations($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);

        $operations = Operation::model()->with('type', 'userCreated')->findAll($criteria);
        $totalCount = Operation::model()->count($criteria);

        return [
            'count' => $totalCount,
            'rows' => AccountancyHelper::toAssocArray($operations, $this->relatedModelsMapping)
        ];
    }

}