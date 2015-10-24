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
        var_dump($payObject->getBasePrice());
        var_dump($this->loanValue);
        var_dump($coeff);
        return round($payObject->getBasePrice() * $coeff);
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate){
        $closeDate = $startDate->modify('+'.$payObject->getDuration().' days' );
        return $closeDate;
    }

    public function getInvoicesList(IBillableObject $payObject,  DateTime $startDate){
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $timeInterval = $payObject->getDuration() / $this->payCount; //days
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject, $startDate),
            $this->payCount);
        var_dump($this->getSumma($payObject, $startDate));

        for($i = 0; $i < $this->payCount; $i++){
            $currentTimeInterval = $currentTimeInterval->modify(' +'.$timeInterval.' days');
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
            var_dump($arrayInvoiceSumma[$i]);
        }
        die();
        return $invoicesList;
    }
}