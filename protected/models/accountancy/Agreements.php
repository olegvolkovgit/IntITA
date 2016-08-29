<?php

class Agreements {

    private $agreementRelationMapping = [
        'user_id' => 'user.fullName',
        'approval_user' => 'approvalUser.fullName',
        'payment_schema' => 'paymentSchema.name',
        'cancel_user' => 'cancelUser.fullName',
        'service_id' => 'service.description'
    ];

    public function getUserAgreements($offset = 0, $limit = 10, $params = null, $filter, $sorting) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);

        foreach ($params as $field => $value) {
            if ($value !== null) {
                $criteria->addCondition("t.$field = $value", 'AND');
            }
        }

        /* TODO move criteria building into model */
        foreach ($filter as $field => $value) {
            if ($value !== null) {
                $filterCriteria = new CDbCriteria();
                $fields = preg_split('/\./', $field);
                if (count($fields) === 1) {
                    $filterCriteria->addSearchCondition("t.$field", $value);
                } else {
                    if ($fields[1] == 'fullName') {
                        $filterCriteria->addSearchCondition("$fields[0].firstName", $value, true, 'OR');
                        $filterCriteria->addSearchCondition("$fields[0].middleName", $value, true, 'OR');
                        $filterCriteria->addSearchCondition("$fields[0].secondName", $value, true, 'OR');
                    } else {
                        $filterCriteria->addSearchCondition("$fields[0].$fields[1]", $value);
                    }
                }
                $criteria->mergeWith($filterCriteria);
            }
        }

        $orderStatement = [];
        foreach ($sorting as $field => $order) {
            if ($order !== null) {

                $fields = preg_split('/\./', $field);
                if (count($fields) === 1) {
                    array_push($orderStatement, "t.$field $order");
                } else {
                    if ($fields[1] == 'fullName') {
                        array_push($orderStatement, "$fields[0].firstName $order");
                        array_push($orderStatement, "$fields[0].middleName $order");
                        array_push($orderStatement, "$fields[0].secondName $order");
                    } else {
                        array_push($orderStatement, "$fields[0].$fields[1] $order");
                    }
                }
            }
        }

        $criteria->order = implode(',', $orderStatement);

        $agreements = UserAgreements::model()->with('user', 'approvalUser', 'paymentSchema')->findAll($criteria);
        $totalCount = UserAgreements::model()->with('user', 'approvalUser', 'paymentSchema')->count($criteria);

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