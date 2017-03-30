<?php
/**
 * @var $params array
 */
$organization = Organization::model()->findByPk($params[0]);
?>
<h4>Вітаємо!</h4>
<span>Тебе призначено співробітником. <?php if($organization){ echo 'Права діють в межах організації <em>"'.$organization->name.'"</em>'; } ?></span>
<br>
<span>Відредагувати профіль співробітника можна в вкладці "Профіль співробітника", що знаходиться в <a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">кабінеті</a></span>
