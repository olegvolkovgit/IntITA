<?php
/**
 * @var $params array
 * @var $user StudentReg
 * @var $author StudentReg
 */
$author = $params[0];
$user = $params[1];
?>
<span>Контент менеджер <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $author->id)) ?>">
        <?= $author->userNameWithEmail() ?></a>
       надіслав запит на призначення користувача <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $user->id)) ?>">
        <?= $user->userNameWithEmail() ?></a> співробітником.</span>
<br>
Підтвердити або скасувати запит: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>#/admin/requests">
    <em>запити</em>
</a>
