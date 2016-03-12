<?php
/**
 * @var $params array
 * @var $model
 */
$model = $params[0];
$hashMail = $params[1];
?>
<h4>Вітаємо!</h4>
<br>
<span><?=Yii::t('recovery', '0283')?></span>
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('site/veremail', array('token' => $model->token,'email' => $hashMail));?>">Змінити email</a>
