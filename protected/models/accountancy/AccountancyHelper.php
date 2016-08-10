<?php

class AccountancyHelper {
    
    public static function toAssocArray($dataArray, $mapRelated) {
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
    
}