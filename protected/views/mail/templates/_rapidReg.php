<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
$lang = $params[1];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<br>
<span><?=Yii::t('activeemail', '0299')?></span>
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('site/AccActivation', array('token'=>$model->token,'email' => $model->email,'lang'=>$lang))?>"><?=Yii::t('mail', '0855')?></a>

