<?php

class Payments {

//    private $relationsMapping = [
//        'agreement_id' => 'agreement.number',
//        'user_created' => 'userCreated.fullName',
//        'user_cancelled' => 'userCancelled.fullName'
//    ];

    public function getTypeahead($query) {
        $models = AccountancyHelper::getTypeahead($query, 'ExternalPays', ['documentNumber', 'documentPurpose', 'comment', 'amount']);
        return AccountancyHelper::toAssocArray($models);
    }

}