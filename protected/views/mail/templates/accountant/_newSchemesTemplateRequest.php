<?php
/**
 * @var $params array
 * @var $service Service
 * @var $user StudentReg
 * @var $schemaTemplate PaymentSchemeTemplate
 */
$service = $params[0];
$user = $params[1];
$schemaTemplate = $params[2];
?>
<span>Користувач <a target="_blank" href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/users/profile/'.$user->id ?>"> <?= $user->userNameWithEmail() ?></a>
    надіслав запит на застосування акційної схеми
    <a href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/accountant/paymentSchemas/schemas/template/'.$schemaTemplate->id ?>" target="_blank">
        <strong><?php echo $schemaTemplate->template_name_ua ?></strong>
    </a>
    до сервісу
    <a href="<?php echo $service->serviceLink();?>" target="_blank">
        <strong><?php echo $service->description ?></strong>
    </a>.
</span>
<br>
Для перегляду запиту, перейдіть у кабінет бухгалтера:
<a href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/accountant' ?>" target="_blank">
    <em>кабінет</em>
</a>