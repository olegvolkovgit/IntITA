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
?>
    <h4>Повідомлення!</h4>
    <br>
Для тебе скасовано схему проплат <strong><?php echo $schemaTemplate->template_name_ua ?></strong>, 
яка була застосована до 
<?php if($serviceType){ echo "усіх сервісів типу: ".$serviceType; } else { ?>
сервісу
<a href="<?php echo $service->serviceLink();?>" target="_blank">
    <strong><?php echo $content ?></strong>
</a>.
<?php } ?>