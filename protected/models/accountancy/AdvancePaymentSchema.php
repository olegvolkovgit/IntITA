<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:35
 */

class AdvancePaymentSchema implements IPaymentCalculator{

    use GracefulDivision;
    public $payCount;
    public $discount;
    private $educForm;

    function __construct($discount, $payCount, EducationForm $educForm){
        $this->discount = $discount;
        $this->payCount = $payCount;
    }

    public function getSumma(IBillableObject $payObject){
        return $payObject->getBasePrice() * (1 - $this->discount/100);
    }

    public function getCloseDate(IBillableObject $payObject,  DateTime $startDate){
        $interval = new DateInterval('P'.$payObject->getDuration().'D');
        $closeDate = $startDate->add($interval);
        return $closeDate->getTimestamp();
    }

    public function getInvoicesList(IBillableObject $payObject,  DateTime $startDate){
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $timeInterval = $payObject->getDuration() / $this->payCount; //days
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject),
            $this->payCount);

        for($i = 0; $i < $this->payCount; $i++){
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
            $currentTimeInterval = $currentTimeInterval->modify(' +'.$timeInterval.' days');
        }
        return $invoicesList;
    }

    public function getSummaOffline(IBillableObject $payObject){
        return $payObject->getBasePrice() * Config::getCoeffModuleOffline() * (1 - $this->discount/100);
    }
}