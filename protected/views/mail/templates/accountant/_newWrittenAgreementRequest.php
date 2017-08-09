<?php
/**
 * @var $params array
 * @var $agreement UserAgreements
 * @var $user StudentReg
 */
$agreement = $params[0];
$user = $params[1];
?>
<span>Користувач <a target="_blank" href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/users/profile/'.$user->id ?>"> <?= $user->userNameWithEmail() ?></a>
    надіслав запит на затвердження паперового договору до сервісу <strong><?php echo $agreement->service->description ?></strong>
</span>
<br>
Для перегляду запиту, перейдіть у кабінет бухгалтера:
<a href="<?= Yii::app()->createAbsoluteUrl('cabinet').'#/accountant' ?>" target="_blank">
    <em>кабінет</em>
</a>