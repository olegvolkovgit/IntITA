<?php

class Invoices {

    public function getInvoices($offset = 0, $limit = 10, $params = null) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);

        foreach ($params as $field=>$value) {
            if (is_array($value)) {
                $criteria->addInCondition($field, $value);
            } else {
                $criteria->addCondition("$field = $value");
            }
        }

        $agreements = Invoice::model()->with('agreement', 'userCancelled', 'userCreated')->findAll($criteria);
        $totalCount = Invoice::model()->count($criteria);

        return [
            'count' => $totalCount,
            'rows' => AccountancyHelper::toAssocArray($agreements, [
                'agreement_id' => 'agreement.number',
                'user_created' => 'userCreated.fullName',
                'user_cancelled' => 'userCancelled.fullName'
            ])
        ];
    }
}