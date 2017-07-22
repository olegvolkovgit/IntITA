<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:35
 */

class AdvancePaymentSchema implements IPaymentCalculator{

    use GracefulDivision;
    public $id;
    public $payCount;
    public $discount;
    private $educForm;
    public $name;
    public $loanValue;
    public $contract;

    function __construct($discount, $loan, $payCount, $educForm, $id, $name, $contract){
        $this->id = $id;
        $this->discount = min($discount, 100);
        $this->loanValue = $loan;
        $this->payCount = $payCount;
        $this->educForm = $educForm;
        $this->name = $name;
        $this->contract = $contract;
    }

    public function getSumma(IBillableObject $payObject){
        $basePrice = $payObject->getBasePrice() * $this->educForm->getCoefficient();
        $coeff =  pow((1 + $this->loanValue/100), $this->payCount/12);
        return round($basePrice * (1 - $this->discount/100)*$coeff);
    }

    public function getCloseDate(IBillableObject $payObject,  DateTime $startDate){
        $interval = new DateInterval('P'.$this->getDuration($startDate).'D');
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

    public function getInvoicesList(IBillableObject $payObject,  DateTime $startDate){
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $timeInterval = ceil($this->getDuration($startDate)/ $this->payCount); //months
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject),
            $this->payCount);

        for($i = 0; $i < $this->payCount; $i++){
            if(isset($arrayInvoiceSumma[$i])){
                array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
                $currentTimeInterval = $currentTimeInterval->modify(' +'.$timeInterval.' month');
            }
        }
        return $invoicesList;
    }

    /**
     * Returns discount, payments count
     * @return mixed
     */
    public function getPaymentProperties() {
        return [
            'discount' => $this->discount,
            'loan' => $this->loanValue,
            'paymentsCount' => $this->payCount,
            'type'=>PaymentScheme::getPaymentType($this->payCount),
            'ico'=>PaymentScheme::getPaymentIco($this->payCount, false),
            'icoCheck'=>PaymentScheme::getPaymentIco($this->payCount, true),
            'translates' => [
                'title' => $this->name,
                'currencySymbol' => Yii::t('courses', '0322'),
                'discount' => Yii::t('courses', '0144'),
                'payment' => Yii::t('course', '0323'),
                'month' => Yii::t('payments', '0865')
            ]
        ];
    }
}