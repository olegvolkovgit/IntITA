<?php

class PaymentHelper
{

    public static function discountedPrice($price, $discount)
    {
        if ($discount == 0) {
            return $price;
        }
        return round($price * (1 - $discount / 100));
    }

}