<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:39
 */

class LoanPaymentSchema implements IPaymentCalculator{

    private $loanValue;
    private $payCount;

    function __construct($loan, $payCount){
        $this->loanValue = $loan;
        $this->payCount = $payCount;
     }

    public function getSumma(IBillableObject $payObject){
        $coeff =  pow((1 + $this->loanValue/100), $this->payCount/12);
        return round($payObject->getBasePrice() * $coeff);
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate){
        $interval = new DateInterval('P'.$payObject->getDuration().'D');
        $closeDate = $startDate->add($interval);
        return $closeDate->getTimestamp();
    }

    public function getInvoicesList(IBillableObject $payObject,  DateTime $startDate){
        $invoicesList = [];
        $currentTimeInterval = $startDate;

        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject, $startDate),
            $this->payCount);

        for($i = 0; $i < $this->payCount; $i++){
            $currentTimeInterval = $currentTimeInterval->modify(' +1 month');
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
        }

        return $invoicesList;
    }
}