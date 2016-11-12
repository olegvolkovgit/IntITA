<?php

interface ISpecialOffer {
    /**
     * Returns payment schemas array for special offers or null if there are no offers
     * @param array $params
     * @return PaymentScheme[] | null
     */
    public function getActualOffer($params);
}