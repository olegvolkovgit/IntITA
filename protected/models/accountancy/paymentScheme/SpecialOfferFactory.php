<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 09.10.16
 * Time: 10:04
 */
class SpecialOfferFactory {

    private $user = null;
    private $service = null;

    const SPECIAL_OFFERS = [
        'UserSpecialOffer',
        'ServiceSpecialOffer'
    ];

    function __construct($user, $service, $schemeId = null) {
        $this->user = $user;
        $this->service = $service;
        $this->schemeId = $schemeId;
    }
    
    public function getSpecialOffer() {
        $specialOffer = null;
        $params = ['user' => $this->user, 'service' => $this->service, 'schemeId' => $this->schemeId];
        foreach (self::SPECIAL_OFFERS as $offerClass) {
            $model = $offerClass::model();
            $specialOffer = $model->getActualOffer($params);
            if (!empty($specialOffer)) {
                break;
            }
        }
        return $specialOffer;
    }

    public function createSpecialOffer($attributes) {
        $offer = null;
        $params = $this->pickPaymentSchemaParams($attributes);

        if ($this->user && $this->service) {
            $offer = new UserSpecialOffer();
            $params['userId'] = $this->user->id;
        } else if ($this->service) {
            $offer = new ServiceSpecialOffer();
        }

        if (!empty($offer)) {
            $params['serviceId'] = $this->service->service_id;
            $offer->setAttributes($params);
            $offer->save();
        }

        return $offer;
    }

    private function pickPaymentSchemaParams($params) {
        $paymentSchemaParams = [
            'discount' => true,
            'loan' => true,
            'name' => true,
            'monthpay' => true,
            'startDate' => true,
            'endDate' => true
        ];
        return array_intersect_key($params, $paymentSchemaParams);
    }
}