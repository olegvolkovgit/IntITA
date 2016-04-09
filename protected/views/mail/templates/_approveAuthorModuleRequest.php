<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Ваш запит на редагування модуля <strong><?=$model->title_ua." (".$model->language.")";?></strong> підтверджено.
<br>
Посилання на редагування модуля э у кабінеті (Автор/модулі у боковому меню): <a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">
    <em>Кабінет</em>
</a><br>
