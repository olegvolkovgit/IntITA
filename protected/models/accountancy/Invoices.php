<?php

class Invoices {

    public function getInvoices($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);
        $agreements = Invoice::model()->with('agreement', 'userCancelled', 'userCreated')->findAll($criteria);
        $totalCount = Invoice::model()->count();

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