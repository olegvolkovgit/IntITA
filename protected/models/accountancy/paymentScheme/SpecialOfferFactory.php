<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 09.10.16
 * Time: 10:04
 */
class SpecialOfferFactory {

    private $params = null;

    const SPECIAL_OFFERS = [
        'UserSpecialOffer',
        'CourseSpecialOffer',
        'ModuleSpecialOffer'
    ];

    function __construct($params) {
        $this->params = $params;
    }
    
    public function getSpecialOffer() {
        $specialOffer = null;
        foreach (self::SPECIAL_OFFERS as $offerClass) {
            $model = $offerClass::model();
            $specialOffer = $model->getActualOffer($this->params);
            if (!empty($specialOffer)) {
                break;
            }
        }
        return $specialOffer;
    }

    public function createSpecialOffer() {
        $offer = null;

        if (key_exists('userId', $this->params)) {
            $offer = new UserSpecialOffer();
        } else if (key_exists('courseId', $this->params)) {
            $offer = new CourseSpecialOffer();
        } else if (key_exists('moduleId', $this->params)) {
            $offer = new ModuleSpecialOffer();
        }

        if (!empty($offer)) {
            $offer->setAttributes($this->params);
            $offer->save();
        }

        return $offer;
    }
}