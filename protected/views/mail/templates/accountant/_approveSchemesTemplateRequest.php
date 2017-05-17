<?php
/**
 * @var $params array
 * @var $service Service
 * @var $schemaTemplate PaymentSchemeTemplate
 */
$serviceType = $params[0];
$service = $params[1];
$content = $params[2];
$schemaTemplate = $params[3];
$startDate = $params[4];
$endDate = $params[5];
?>
<h4>Вітаємо!</h4>
<br>
Для тебе призначено схему проплат <strong><?php echo $schemaTemplate->template_name_ua ?></strong>
Схема застосована до 
<?php if($serviceType){ echo "усіх сервісів типу: ".$serviceType.'.'; } else { ?>
сервісу
<a href="<?php echo $service->serviceLink();?>" target="_blank">
    <strong><?php echo $content ?></strong>
</a>.
<?php } ?>
    Перейди на сторінку відповідного курсу/модуля, обери схему, яка тобі підходить та натисни кнопку "ОПЛАТИТИ КУРС/МОДУЛЬ \>"
<?php if($startDate || $endDate){ echo "Схема діє "; }?>
<?php if($startDate){ echo "з ".$startDate; } ?> <?php if($endDate && $endDate!='9999-12-31 23:59:59'){ echo " по ".$endDate; } ?>