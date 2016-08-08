<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 06.08.16
 * Time: 13:22
 */
class Agreements {

    private function toAssocArray($dataArray) {
        $result = [];
        if (is_array($dataArray)) {
            foreach ($dataArray as $item) {
                array_push($result, $item->getAttributes());
            }
        }
        return $result;
    }

    public function getUserAgreements($offset = 0, $limit=10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);
        $agreements = UserAgreements::model()->findAll($criteria);
        
        return $this->toAssocArray($agreements);
    }
}