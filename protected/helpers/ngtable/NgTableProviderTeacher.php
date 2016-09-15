<?php

class NgTableProviderTeacher extends NgTableProviderDefault {
    
    private $allowedRelations = ['user'];
    public function getRelations() {
        return array_intersect_key($this->owner->relations(), array_flip($this->allowedRelations));
    }
}