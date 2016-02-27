<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
<span><?=Yii::t('recovery', '0239')?></span>
<br>
<a href="<?=Yii::app()->createAbsoluteUrl('site/vertoken',array('token' => $model->token, 'activkey_lifetime' => $model->activkey_lifetime))?>></a>