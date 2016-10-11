<?php

class Payments {

    public function getTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'ExternalPays', ['documentNumber', 'documentPurpose', 'comment', 'amount']);
        return ActiveRecordToJSON::toAssocArray($models);
    }

}