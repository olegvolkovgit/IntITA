<?php
/**
 * @var $params array
 * @var $model Module
 * @var $trainer Teacher
 */
$model = $params[0];
$trainer = $params[1];
?>
<h4>Повідомлення</h4>
<br>
Тобі скасовано доступ до модуля <a
    href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>"
    target="_blank">
    <em><?= $model->title_ua . ", (" . $model->language . ")"; ?></em>
</a>
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => $trainer->user_id
)); ?>">написати тренеру</a>.
<br>
