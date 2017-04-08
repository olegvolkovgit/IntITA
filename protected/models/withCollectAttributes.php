<?php

trait withCollectAttributes {

    abstract function attributeNames();

    function collectAttributes($array) {
        $attributes = [];
        foreach ($this->attributeNames() as $name) {
            if (key_exists($name, $array)) {
                $attributes[$name] = $array[$name];
            }
        }
        return $attributes;
    }
}