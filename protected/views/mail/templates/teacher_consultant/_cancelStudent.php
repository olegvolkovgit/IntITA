<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
$module = $params[1];
?>
<h4>Повідомлення</h4>
<br>
Вам скасовано студента (перевірка задач та консультування) <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $student->id)); ?>">
        <?= $student->userNameWithEmail(); ?>
    </a>
</strong> по модулю <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $module->module_ID)); ?>">
        <?= $module->getTitle(); ?>
    </a>
</strong>.
<br>
Кабінет викладача (вкладка "Викладач"): <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => Config::getAdminId()
)); ?>">написати адміністратору</a>.