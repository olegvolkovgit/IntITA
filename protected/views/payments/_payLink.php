<?php
/*
 * @var Invoice $data
 * @var integer $cssClass
 * $row  Row
 * @var $this PaymentsController
 */
?>
   <span class="<?php echo $cssClass?>">
       Рахунок № 
        <?=$data->id;?> Сплатити
        <?=number_format(CommonHelper::getPriceUah($data->summa), 2, ",", " ")?> грн. до
        <?=date("d.m.y", strtotime($data->payment_date))?>
   </span>


