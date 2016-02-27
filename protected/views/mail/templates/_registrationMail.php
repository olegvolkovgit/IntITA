<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<span><?=Yii::t('activeemail', '0299')?></span>
<a href="<?=Yii::app()->createAbsoluteUrl('site/AccActivation' ,array('token'=>$model->token ,'email'=>$model->email ,'lang'=>$lang));?>">Активувати</a>
<br>
​З повагою, INTITA​;