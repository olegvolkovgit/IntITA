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

    function __construct($discount, $payCount, $educForm){
        $this->discount = min($discount, 100);
        $this->payCount = $payCount;
        $this->educForm = $educForm;
    }

    public function getSumma(IBillableObject $payObject){
        $basePrice = $payObject->getBasePrice() * $this->educForm->getCoefficient();
        return $basePrice * (1 - $this->discount/100);
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

    /**
     * Returns discount, payments count
     * @return mixed
     */
    public function getPaymentProperties() {
        return [
            'discount' => $this->discount,
            'paymentsCount' => $this->payCount,
            'translates' => [
                'title' => $this->payCount == 1 ? Yii::t('course', '0197') : $this->payCount . ' ' . Yii::t('course', '0198'),
                'currencySymbol' => Yii::t('courses', '0322'),
                'discount' => Yii::t('courses', '0144'),
                'payment' => Yii::t('course', '0323'),
                'month' => Yii::t('payments', '0865')
            ]
        ];
    }
}