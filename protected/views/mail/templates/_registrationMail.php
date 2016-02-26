<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
Yii::t('activeemail', '0299')
<span>
<a href="<?=Yii::app()->createAbsoluteUrl('/index.php?r=site/AccActivation/view&token=', array($model->token,$model->token, $lang, $model->email));?>"> .</span>
<br>
​З повагою, INTITA​;