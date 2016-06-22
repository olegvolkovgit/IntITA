<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Тобі надано права для редагування контенту модуля <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>">
        <?= $model->getTitle(); ?>
    </a>
</strong>.
<br>
Кабінет автора модулів (вкладка "Автор"): <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>