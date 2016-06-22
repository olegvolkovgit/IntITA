<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Повідомлення</h4>
<br>
Тобі скасовано права автора для модуля <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>">
        <?= $model->getTitle(); ?>
    </a>
</strong>.
<br>
Кабінет автора модулів (вкладка "Автор"): <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => Config::getAdminId()
)); ?>">написати адміністратору</a>.