<?php
/**
 * @var $model StudentReg
 * @var $params array
 */
 $model = $params[0];
?>
У тебе є нове приватне повідомлення від <?=$model->userNameWithEmail();?>. Ти можеш його прочитати у своєму
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">кабінеті</a>.
