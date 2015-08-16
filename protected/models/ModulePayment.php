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
    protected $service_model = 'ModuleService';
    protected $service_id_param = 'module_id';
    
    public $module_id;
    
        
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
}
