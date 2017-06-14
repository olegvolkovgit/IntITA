<?php

class Payments {

    public function getTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'ExternalPays', ['documentNumber', 'documentPurpose', 'comment', 'amount','payerName','payerId'], 10, true);
        return ActiveRecordToJSON::toAssocArray($models);
    }

}