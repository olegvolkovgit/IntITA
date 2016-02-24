<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
<span>Щоб приєднати дану електрону адресу до соціальної мережі <strong><?=$model->identity;?></strong>, будь ласка перейди за посиланням:</span>
<br>
<span>Щоб продивитися нову задачу, перейди за посиланням:
<a href="<?=Yii::app()->createAbsoluteUrl('/index.php?r=site/linkingEmailToNetwork/view&network=', array($model->identity,$model->token,urlencode($mailHash,  $lang) ));?>"> .</span>
<br>
​З повагою, INTITA​;
