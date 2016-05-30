<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
$hashMail = $params[1];
$lang = $params[2];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<br>
<span><?=Yii::t('mail', '0841')?> <strong><?=$model->identity;?></strong><?=Yii::t('mail', '0842')?></span>
<br>
<a href="<?=Yii::app()->createAbsoluteUrl('site/linkingEmailToNetwork', array('network' => $model->identity,'token' => $model->token,'email' => $hashMail,$model->identity, 'lang'=>$lang))?>"><?=Yii::t('mail', '0843')?></a>.
<br>
<?=Yii::t('mail', '0840')?>
