<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Тобі запит на редагування модуля <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>" target="_blank">
        <?= $model->title_ua . " (" . $model->language . ")"; ?>
    </a>
</strong> підтверджено.
<br>
Посилання на редагування модуля у кабінеті (Автор/модулі у боковому меню): <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>