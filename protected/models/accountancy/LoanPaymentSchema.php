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
    private $educForm;

    function __construct($loan, $payCount, $educForm){
        $this->loanValue = $loan;
        $this->payCount = $payCount;
        $this->educForm = $educForm;
     }

    public function getSumma(IBillableObject $payObject){
        $basePrice = ($this->educForm->isOnline())?$payObject->getBasePrice():$payObject->getBasePrice() * Config::getCoeffModuleOffline();
        $coeff =  pow((1 + $this->loanValue/100), $this->payCount/12);
        return round($basePrice * $coeff);
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate){
        $interval = new DateInterval('P'.$payObject->getDuration().'D');
        $closeDate = $startDate->add($interval);
        return $closeDate->getTimestamp();
    }

    public function getInvoicesList(IBillableObject $payObject,  DateTime $startDate){
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject),
            $this->payCount);

        for($i = 0; $i < $this->payCount; $i++){
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
            $currentTimeInterval = $currentTimeInterval->modify(' +1 month');
        }

        return $invoicesList;
    }

    public function yearsCount(){
        return $this->payCount / 12;
    }
}