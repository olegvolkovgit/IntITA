<?php

class NgTableProviderTeacher extends NgTableProviderDefault {
    
    private $excludeRelations = ['modulesActive'];
    
    public function getRelations() {
        return array_filter($this->owner->relations(), function ($value, $key) {
           return array_search($key, $this->excludeRelations);
        }, ARRAY_FILTER_USE_BOTH);
    }
}