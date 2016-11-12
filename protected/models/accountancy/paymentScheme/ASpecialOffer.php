<?php

abstract class ASpecialOffer extends CActiveRecord implements ISpecialOffer{

    /**
     * Returns criteria to fetch special offer data from DB
     * @param array $params
     * @return CDbCriteria|null
     */
    abstract protected function getConditionCriteria($params);
    abstract protected function getTableScope();

    public function defaultScope() {
        return $this->getTableScope();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'acc_payment_schema';
    }

    public function getActualOffer($params) {
        $paymentSchemas = null;
        $criteria = $this->getConditionCriteria($params);

        if (!empty($criteria)) {
            $paymentSchemas = array_map(function($offer) {
                return $offer;
            }, $this->findAll($criteria));
        }

        return !empty($paymentSchemas) ? $paymentSchemas : null;
    }
}