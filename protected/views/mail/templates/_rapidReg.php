<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
<span><?=Yii::t('activeemail', '0299')?></span>
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('site/AccActivation', array('token'=>$model->token,'email' => $model->email,'lang'=>$lang))?>"></a>

