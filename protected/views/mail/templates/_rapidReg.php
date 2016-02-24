<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Yii::t('activeemail', '0299')
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('/index.php?r=site/AccActivation/view&token=', array($model->token, $model->email, $lang));?>">

