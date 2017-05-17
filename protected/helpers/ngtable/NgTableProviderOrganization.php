<?php

class NgTableProviderOrganization extends NgTableProviderDefault {
    
    private $allowedRelations = [];
    public function getRelations() {
        return array_intersect_key($this->owner->relations(), array_flip($this->allowedRelations));
    }
}