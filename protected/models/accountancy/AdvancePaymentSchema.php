<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:35
 */

class AdvancePaymentSchema implements IPaymentCalculator{

    public $payCount;
    public $discount;

    function __construct($discount, $payCount){
        $this->discount = $discount;
        $this->payCount = $payCount;
    }

    public function getSumma(IBillableObject $payObject){
        return $payObject->getBasePrice() * (1 - $this->discount/100);
    }

    public function getCloseDate(IBillableObject $payObject, $startDate){
        return $startDate + $payObject->getDuration();
    }

    public function getInvoicesList(IBillableObject $payObject, $startDate){
        return [];
    }
}