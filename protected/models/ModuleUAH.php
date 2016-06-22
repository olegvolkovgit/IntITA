<?php

class ModuleUAH implements IBillableObject
{
    //Original model
    private $module;
    private $basePrice;

    function ModuleUAH(Module $module){
        $this->module = $module;
        $this->basePrice = $module->getBasePrice() * Config::getDollarRate();
    }

    public function getBasePrice(){
        return $this->basePrice;
    }

    public function getDuration(){
        return $this->module->getDuration();
    }

    public function getModelUAH(){
        return $this;
    }
}