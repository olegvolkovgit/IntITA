<?php

trait GracefulDivision
{
    public static function getArrayInvoiceSumma($summa, $payCount){
        $arrayInvoiceSumma = [];

        $pay = ceil($summa * 100 / $payCount);
        $pay /= 100;

        while ($summa > 0) {
            $arrayInvoiceSumma[] = min($pay, $summa);
            $summa -= $pay;
        }
        if(count($arrayInvoiceSumma)){
            $arrayInvoiceSumma[count($arrayInvoiceSumma)-1]=round($arrayInvoiceSumma[count($arrayInvoiceSumma)-1],2);
        }
        return  $arrayInvoiceSumma;
    }
}