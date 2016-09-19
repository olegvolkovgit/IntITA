<?php

class NgTableProviderModule extends NgTableProviderDefault {

    private $allowedRelations = ['level0'];
    public function getRelations() {
        return array_intersect_key($this->owner->relations(), array_flip($this->allowedRelations));
    }
}