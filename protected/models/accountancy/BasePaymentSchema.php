<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.10.2015
 * Time: 14:41
 */
class BasePaymentSchema implements IPaymentCalculator {

    public $payCount;
    private $educForm;

    function __construct($payCount, $educForm) {
        $this->payCount = $payCount;
        $this->educForm = $educForm;
    }

    public function getSumma(IBillableObject $payObject) {
        return $payObject->getBasePrice() * $this->educForm->getCoefficient();
    }

    public function getCloseDate(IBillableObject $payObject, DateTime $startDate) {
        $interval = new DateInterval('P' . $payObject->getDuration() . 'D');
        $closeDate = $startDate->add($interval);
        return $closeDate->getTimestamp();
    }

    public function getInvoicesList(IBillableObject $payObject, DateTime $startDate) {
        $invoicesList = [];
        $currentTimeInterval = $startDate;
        $arrayInvoiceSumma = GracefulDivision::getArrayInvoiceSumma($this->getSumma($payObject),
            $this->payCount);

        for ($i = 0; $i < $this->payCount; $i++) {
            array_push($invoicesList, Invoice::createInvoice($arrayInvoiceSumma[$i], $currentTimeInterval));
            $currentTimeInterval = $currentTimeInterval->modify(' +1 month');
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
            'translates' => [
                'title' => Yii::t('course', '0200'),
                'currencySymbol' => Yii::t('courses', '0322'),
                'payment' => Yii::t('course', '0323'),
                'month' => Yii::t('payments', '0865')
            ]
        ];
    }
}