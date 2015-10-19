<?php

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