<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
?>
<h4>Повідомлення</h4>
<br>
Вам скасовано студента <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $student->id)); ?>">
        <?= $student->userNameWithEmail(); ?>
    </a>
</strong>.
<br>
Кабінет тренера (вкладка "Тренер"): <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => Config::getAdminId()
)); ?>">написати адміністратору</a>.