<?php

/* 
 * $data Invoice model    
 * $row  Row
 * $this Payments Controller
 */
?>
   <span class="<?=$data->getInvoiceStatus()?>">
       Рахунок № 
        <?=$data->id?> Сплатити 
        <?=number_format(PaymentHelper::getPriceUah($data->summa), 2, ",", " ")?> грн. до 
        <?=date("d.m.y", strtotime($data->payment_date))?>
   </span>


