<?php

trait GracefulDivision
{
    public static function getArrayInvoiceSumma($summa, $payCount){
        $arrayInvoiceSumma = [];

        $pay = round($summa / $payCount, 2);
        for($i = 0; $i < ($payCount - 1); $i++){
            $arrayInvoiceSumma[$i] = $pay;
        }
        $arrayInvoiceSumma[$payCount - 1] = $summa - $pay * ($payCount - 1);

        return  $arrayInvoiceSumma;
    }
}