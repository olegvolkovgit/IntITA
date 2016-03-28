<?php
/**
 * @var $params array
 * @var $plainTaskAnswer PlainTaskAnswer
 */
$plainTaskAnswer = $params[0];
?>
<h4>Вітаємо!</h4>
<span>У Тебе з'явилася нова задача для перевірки : <strong><?= $plainTaskAnswer->answer;?></strong>.</span>
<br>
<span>Щоб продивитися нову задачу, перейди за посиланням:</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/teacher/checkPlainTaskAnswer',array('id' => $plainTaskAnswer->id_plain_task));?>">Задача до перевірки</a>
<br>
​З повагою, INTITA​;
