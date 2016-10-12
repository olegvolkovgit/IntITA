<?php

abstract class ASpecialOffer extends CActiveRecord implements ISpecialOffer{

    /**
     * Returns criteria to fetch special offer data from DB
     * @param array $params
     * @return CDbCriteria|null
     */
    abstract protected function getConditionCriteria($params);

    public function makeSchema() {
        $paymentSchema = new PaymentScheme();
        $paymentSchema->setAttributes(
            [
                'discount' => $this->discount,
                'pay_count' => $this->payCount,
                'loan' => $this->loan,
                'name' => $this->name,
                'monthpay' => $this->monthpay
            ]
        );
        return $paymentSchema;
    }

    public function getActualOffer($params) {
        $paymentSchemas = null;
        $criteria = $this->getConditionCriteria($params);

        if (!empty($criteria)) {
            $paymentSchemas = array_map(function($offer) {
                return $offer->makeSchema();
            }, $this->findAll($criteria));
        }

        return !empty($paymentSchemas) ? $paymentSchemas : null;
    }
}