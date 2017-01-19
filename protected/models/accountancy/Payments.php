<?php

class Payments {

    public function getTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'ExternalPays', ['documentNumber', 'documentPurpose', 'comment', 'amount','payerName','payerId']);
        return ActiveRecordToJSON::toAssocArray($models);
    }

}