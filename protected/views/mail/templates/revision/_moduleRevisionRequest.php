<?php
/**
 * @var $params array
 * @var $author StudentReg
 * @var $revision RevisionModule
 */
$author = $params[0];
$revision = $params[1];
?>
<span>Автор
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $author->id)) ?>" target="_blank">
        <?= $author->userNameWithEmail() ?>
    </a>
       надіслав запит на затвердження ревізії модуля
    <a href="<?= Yii::app()->createAbsoluteUrl('moduleRevision/previewModuleRevision', array('idRevision' => $revision->id_module_revision)) ?>">
        Ревізія <?= $revision->id_module_revision ?>.
    </a>
</span>
<br>
Підтвердити або скасувати запит:
<a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>">
    <em>Кабінет</em>
</a>
