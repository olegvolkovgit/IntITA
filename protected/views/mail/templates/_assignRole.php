<?php
/**
 * @var $params array
 * @var $role string
 */
$role = $params[0];
?>
<h4>Вітаємо!</h4>
<span>Тобі призначено роль <strong><?=$role;?></strong>.</span>
<br>
<span>Переглянути доступний функціонал можна у кабінеті:</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">Кабінет</a>
