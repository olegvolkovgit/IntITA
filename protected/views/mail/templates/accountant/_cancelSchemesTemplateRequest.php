<?php
/**
 * @var $params array
 * @var $service Service
 * @var $schemaTemplate PaymentSchemeTemplate
 */
$service = $params[0];
$schemaTemplate = $params[1];
$comment = $params[2];
?>
<h4>Повідомлення!</h4>
<br>
Твій запит на призначення акційної схеми <strong><?php echo $schemaTemplate->template_name_ua ?></strong>
до сервісу 
<a href="<?php echo $service->serviceLink();?>" target="_blank">
    <strong><?php echo $service->description ?></strong>
</a>
</strong> відхилено <?php if(!empty($comment)){ ?> з коментарем "<em><?php echo $comment ?></em>"<?php } ?>