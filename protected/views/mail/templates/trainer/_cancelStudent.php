<?php
/**
 * @var $params array
 * @var $student StudentReg
 */
$student = $params[0];
$organization = Organization::model()->findByPk($params[1]);
?>
<h4>Повідомлення</h4>
<br>
Вам скасовано студента, як тренеру <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $student->id)); ?>">
        <?= $student->userNameWithEmail(); ?>
    </a>
</strong>.
<?php if($organization){ echo 'В межах організації <em>"'.$organization->name.'"</em>'; } ?>
<br>