<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
$hashMail = $params[1];
$lang = $params[2];
?>
<h4>Вітаємо!</h4>
<br>
<span>Щоб приєднати дану електронну адресу до соціальної мережі <strong><?=$model->identity;?></strong>, будь ласка перейди за посиланням:</span>
<br>
<a href="<?=Yii::app()->createAbsoluteUrl('site/linkingEmailToNetwork', array('network' => $model->identity,'token' => $model->token,'email' => $hashMail,$model->identity, 'lang'=>$lang))?>">Приєднати</a>.
<br>
​З повагою, INTITA​;
