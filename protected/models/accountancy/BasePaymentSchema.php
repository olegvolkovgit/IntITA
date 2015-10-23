<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:41
 */

class BasePaymentSchema implements IPaymentCalculator{

    public $payCount;

    function __construct($payCount){
        $this->payCount = $payCount;
    }

    public function getSumma(IBillableObject $payObject){
        return $payObject->getBasePrice();
    }

    public function getCloseDate(IBillableObject $payObject, $startDate){
        return $startDate + $payObject->getDuration();
    }

    public function getInvoicesList(IBillableObject $payObject, $startDate){
        return [];
    }
}