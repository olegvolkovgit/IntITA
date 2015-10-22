<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:41
 */

class StraightPaymentSchema extends PaymentScheme{


    public function getSumma(){
        return 100;
    }

    public function getCloseDate(){
        return date(DateTime::W3C);
    }

    public function getInvoicesList(){
        return [];
    }
}