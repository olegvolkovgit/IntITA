<?php
/**
 * @var $params array
 * @var $model Module
 * @var $author StudentReg
 */
$model = $params[0];
$author = $params[1];
?>
<span>Користувач <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $author->id)) ?>">
        <?= $author->userNameWithEmail() ?></a>
       надіслав запит на редагування модуля
    <a href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)) ?>">
        <strong><?= $model->title_ua; ?></strong>
    </a>.</span>
<br>
Призначити автору модуль: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>#/admin/teacher/<?php echo $author->id ?>/editRole/role/author">
    <em>призначити модуль</em>
</a>
