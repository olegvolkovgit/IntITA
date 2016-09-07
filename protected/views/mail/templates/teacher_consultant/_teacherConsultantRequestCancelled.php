<?php
/**
 * @var $params array
 * @var $model StudentReg
 */
$model = $params[0];
?>
<h4>Повідомлення</h4>
<br>Твій запит на призначення викладачем співробітника <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $model->id)); ?>">
        <?= $model->userNameWithEmail(); ?>
    </a>
</strong> відхилено.
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index')?>#/newmessages/receiver/<?php echo Config::getAdminId(); ?>">написати адміністратору</a>.