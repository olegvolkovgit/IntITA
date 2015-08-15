<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModulePayment
 *
 * @author alterego4
 */
class ModulePayment extends InternalPays
{
    public function relations() {
        $resultarray = parent::relations();
        array_push($resultarray,array('service' => array(self::BELONGS_TO, 'ModuleService', 'service_id')));
        return $resultarray;
    }
    //put your code here
    
}
