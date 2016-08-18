<?php

class Agreements {

    private $agreementRelationMapping = [
        'user_id' => 'user.fullName',
        'approval_user' => 'approvalUser.fullName',
        'payment_schema' => 'paymentSchema.name',
        'cancel_user' => 'cancelUser.fullName',
        'service_id' => 'service.description'
    ];

    public function getUserAgreements($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);
        $agreements = UserAgreements::model()->with('user', 'approvalUser', 'paymentSchema')->findAll($criteria);
        $totalCount = UserAgreements::model()->count($criteria);

        return [
            'count' => $totalCount,
            'rows' => AccountancyHelper::toAssocArray($agreements, $this->agreementRelationMapping)
        ];
    }

    public function getUserAgreement($agreementId) {
        $agreement = UserAgreements::model()->with('user', 'approvalUser', 'cancelUser', 'paymentSchema')->findByPk($agreementId);
        return AccountancyHelper::toAssocArray($agreement, $this->agreementRelationMapping);
    }
    
    public function getTypeahead($agreementNumber) {
        $models = AccountancyHelper::getTypeahead($agreementNumber, 'UserAgreements', ['number']);
        return AccountancyHelper::toAssocArray($models, $this->agreementRelationMapping);
    }
}