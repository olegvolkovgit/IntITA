<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 06.08.16
 * Time: 13:22
 */
class Agreements {

    private function toAssocArray($dataArray, $mapRelated) {
        $result = [];
        if (is_array($dataArray)) {
            foreach ($dataArray as $userAgreement) {
                $mappedAssoc = $userAgreement->getAttributes();
                if ($mapRelated) {
                    foreach ($mapRelated as $key=>$item) {
                        $path = preg_split('/\./', $item);
                        $mappedAssoc[$key] = $userAgreement[$path[0]][$path[1]];
                    }
                }
                array_push($result, $mappedAssoc);
            }
        }
        return $result;
    }

    public function getUserAgreements($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);
        $agreements = UserAgreements::model()->with('user', 'approvalUser', 'paymentSchema')->findAll($criteria);
        $totalCount = UserAgreements::model()->count();

        return [
            'count' => $totalCount,

            'rows' => $this->toAssocArray($agreements, [
                'user_id' => 'user.fullName',
                'approval_user' => 'approvalUser.fullName',
                'payment_schema' => 'paymentSchema.name'
            ])
        ];
    }
}