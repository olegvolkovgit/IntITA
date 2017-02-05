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
        'UserSpecialOfferForAllServices',
        'ServiceSpecialOffer',
        'PromotionServiceSpecialOffer',
    ];

    function __construct($user, $service, $schemeId = null) {
        $this->user = $user;
        $this->service = $service;
        $this->schemeId = $schemeId;
    }
    
    public function getSpecialOffer() {
        $specialOffer = null;

        $params = ['user' => $this->user, 'service' => $this->service, 'schemeId' => $this->schemeId];
        foreach (self::SPECIAL_OFFERS as $key=>$offerClass) {
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
            $params['userId'] = $this->user->id;
            $params['serviceId'] = $this->service->service_id;
            $offer=UserSpecialOffer::model()->findByAttributes(array('userId'=>$params['userId'],'serviceId'=>$params['serviceId']));
            if(!$offer){
                $offer = new UserSpecialOffer();
            }
        } else if($this->user && !$this->service) {
            $params['userId'] = $this->user->id;
            $offer=UserSpecialOfferForAllServices::model()->findByAttributes(
                array('userId'=>$params['userId'],'serviceId'=>null, 'serviceType'=>$params['serviceType'])
            );
            if(!$offer){
                $offer = new UserSpecialOfferForAllServices();
            }
        }else if ($this->service) {
            $params['serviceId'] = $this->service->service_id;
            $offer=ServiceSpecialOffer::model()->findByAttributes(array('userId'=>null,'serviceId'=>$params['serviceId']));
            if(!$offer){
                $offer = new ServiceSpecialOffer();
            }
        }

        if (!empty($offer)) {
            $offer->setAttributes($params);
            $offer->save();
        }

        return $offer;
    }

    private function pickPaymentSchemaParams($params) {
        $paymentSchemaParams = [
            'id_template' => true,
            'serviceType' => true,
            'startDate' => true,
            'endDate' => true
        ];
        return array_intersect_key($params, $paymentSchemaParams);
    }
}