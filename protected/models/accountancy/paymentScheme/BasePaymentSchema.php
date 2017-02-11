<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:41
 */
class BasePaymentSchema implements IPaymentCalculator {

    public $id;
    public $payCount;
    private $educForm;
    private $name;
    
    function __construct($payCount, $educForm, $id, $name) {
        $this->id = $id;
        $this->payCount = $payCount;
        $this->educForm = $educForm;
        $this->name = $name;
    }

    public function getSumma(IBillableObject $payObject) {
        return $payObject->getBasePrice() * $this->educForm->getCoefficient();
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate) {
        $interval = new DateInterval('P' . $this->getDuration($startDate) . 'D');
        $closeDate = $startDate->add($interval);
        return $closeDate;
    }
    //month
    public function getDuration(DateTime $startDate){
        $endDate = clone $startDate;
        if($this->payCount>12){
            return $this->payCount;
        }else{
            $endDate->modify('+1 year');
            $interval = date_diff($startDate, $endDate);
            return round($interval->days/30);
        }
    }
    
    public function getInvoicesList(IBillableObject $payObject, DateTime $startDate) {
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $timeInterval = ceil($this->getDuration($startDate)/ $this->payCount); //months
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject),
            $this->payCount);

        for ($i = 0; $i < $this->payCount; $i++) {
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
            $currentTimeInterval = $currentTimeInterval->modify(' +'.$timeInterval.' month');
        }
        return $invoicesList;
    }

    /**
     * Returns discount, payments count
     * @return mixed
     */
    public function getPaymentProperties() {
        return [
            'paymentsCount' => $this->payCount,
            'type'=>PaymentScheme::getPaymentType($this->payCount),
            'ico'=>PaymentScheme::getPaymentIco($this->payCount, false),
            'icoCheck'=>PaymentScheme::getPaymentIco($this->payCount, true),
            'translates' => [
                'title' => Yii::t('course', '0200'),
                'currencySymbol' => Yii::t('courses', '0322'),
                'payment' => Yii::t('course', '0323'),
                'month' => Yii::t('payments', '0865')
            ]
        ];
    }
}