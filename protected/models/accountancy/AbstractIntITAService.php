<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractService
 *
 * @author alterego4
 */
abstract class AbstractIntITAService extends CActiveRecord
{
    protected static function createService($serviceClass,$service_param,$service_param_value) 
    {
        $service = new $serviceClass();
        $service->$service_param = $service_param_value;
        $service->save();
        return $service;
    }
}
