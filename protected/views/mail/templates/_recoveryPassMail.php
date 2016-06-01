<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<br>
<span><?=Yii::t('recovery', '0239')?></span>
<br>
<a href="<?=Yii::app()->createAbsoluteUrl('site/vertoken',array('token' => $model->token))?>"><?=Yii::t('mail', '0856')?></a>