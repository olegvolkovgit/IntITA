<?php
/**
 * @var $params array
 * @var $plainTaskAnswer PlainTaskAnswer
 */
$plainTaskAnswer = $params[0];
?>
<h4>Повідомлення</h4>
<span>У Тебе з'явилася нова задача для перевірки : <strong><?= $plainTaskAnswer->answer;?></strong>.</span>
<br>
<span>Продивитися нову задачу можна у кабінеті (вкладка Викладач):</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">Кабінет</a>
