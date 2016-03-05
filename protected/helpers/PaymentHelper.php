<?php

class PaymentHelper
{
    public static function getPriceUah($summa)
    {
        return round($summa * 22);//CommonHelper::getDollarExchangeRate(), 2);
    }

    public static function discountedPrice($price, $discount)
    {
        if ($discount == 0) {
            return $price;
        }
        return round($price * (1 - $discount / 100));
    }

}