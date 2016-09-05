<?php
/**
 * @var $params array
 * @var $model Module
 * @var $teacher StudentReg
 * @var $author StudentReg
 */
$model = $params[0];
$author = $params[1];
$teacher = $params[2];
?>
<span>Тренер <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $author->id)) ?>">
        <?= $author->userNameWithEmail() ?></a>
       надіслав запит на призначення викладача <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $teacher->id)) ?>">
        <?= $teacher->userNameWithEmail() ?></a> викладачем-консультантом для модуля
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)) ?>">
        <strong><?= $model->title_ua; ?></strong>
    </a>.</span>
<br>
Підтвердити або скасувати запит: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>#/admin/requests">
    <em>запити</em>
</a>
