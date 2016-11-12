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
        $basePrice = $payObject->getBasePrice() * $this->educForm->getCoefficient();
        $coeff =  pow((1 + $this->loanValue/100), $this->payCount/12);
        return round($basePrice * $coeff);
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate){
        $interval = new DateInterval('P'.$payObject->getDuration().'D');
        $closeDate = $startDate->add($interval);
        return $closeDate;
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
                'title' => Yii::t('course', '0425') . ' ' . $this->yearsCount() . ' ' . CommonHelper::getYearsTermination($this->yearsCount()),
                'currencySymbol' => Yii::t('courses', '0322'),
                'payment' => Yii::t('course', '0324'),
                'month' => Yii::t('payments', '0865')
            ]

        ];
    }
}