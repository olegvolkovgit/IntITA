<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.10.2015
 * Time: 14:24
 */

interface IPaymentCalculator {

    public function getSumma(IBillableObject $payObject);
    public function getCloseDate(IBillableObject $payObject, $startDate);
    public function getInvoicesList(IBillableObject $payObject, $startDate);
}