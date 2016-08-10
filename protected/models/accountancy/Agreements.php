<?php

class Agreements {

    public function getUserAgreements($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);
        $agreements = UserAgreements::model()->with('user', 'approvalUser', 'paymentSchema')->findAll($criteria);
        $totalCount = UserAgreements::model()->count();

        return [
            'count' => $totalCount,
            'rows' => AccountancyHelper::toAssocArray($agreements, [
                'user_id' => 'user.fullName',
                'approval_user' => 'approvalUser.fullName',
                'payment_schema' => 'paymentSchema.name'
            ])
        ];
    }
}