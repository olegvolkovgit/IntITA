<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Повідомлення!</h4>
<br>
Твій запит на редагування модуля <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>">
        <?= $model->title_ua . " (" . $model->language . ")"; ?>
    </a>
</strong> відхилено.
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index')?>#/newmessages/receiver/<?php echo Config::getAdminId(); ?>">написати адміністратору</a>.