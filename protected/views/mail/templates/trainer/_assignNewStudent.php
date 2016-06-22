<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
?>
<h4>Повідомлення</h4>
<span>Вам призначено нового студента для супроводу
    <a href="<?=Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $student->id));?>" target="_blank">
        <strong><?= $student->userNameWithEmail();?></strong>
        </a>
    .</span>
<br>
<span>Перейти у кабінет (вкладка Тренер -> Студенти):</span>
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>">Кабінет</a>
