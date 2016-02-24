<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
<span>У Вас з'явилася нова задача для перевірки : <strong><?=$plainTaskAnswer->answer;?></strong>.</span>
<br>
<span>Щоб продивитися нову задачу, перейди за посиланням:
<a href="<?=Yii::app()->createAbsoluteUrl('_teacher/teacher/checkPlainTaskAnswer', array($plainTaskAnswer->id));?>"> .</span>
    .'Задача до перевірки'."
<br>
​З повагою, INTITA​;
