<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
$module = $params[1];
?>
<h4>Повідомлення</h4>
<span>Тобі призначено нового студента для перевірки задач та консультування
    <a href="<?=Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $student->id));?>" target="_blank">
        <strong><?= $student->userNameWithEmail();?></strong>
    </a> по модулю <strong>
        <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $module->module_ID)); ?>">
            <?= $module->getTitle(); ?>
        </a>
    </strong>.</span>
<br>
<span>Перейти у кабінет (вкладка Викладач -> Студенти):</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>#/teacherConsultant/students">студенти</a>
