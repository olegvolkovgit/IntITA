<?php
/**
 * @var $params array
 * @var $model
 */
$model = $params[0];
$hashMail = $params[1];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<br>
<span><?=Yii::t('recovery', '0283')?></span>
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('site/veremail', array('token' => $model->token,'email' => $hashMail));?>"><?=Yii::t('mail', '0857')?></a>
