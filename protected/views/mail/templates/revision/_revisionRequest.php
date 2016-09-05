<?php
/**
 * @var $params array
 * @var $author StudentReg
 * @var $revision RevisionLecture
 */
$author = $params[0];
$revision = $params[1];
?>
<span>Автор
    <a href="<?= Yii::app()->createAbsoluteUrl('studentreg/profile', array('idUser' => $author->id)) ?>" target="_blank">
        <?= $author->userNameWithEmail() ?>
    </a>
       надіслав запит на затвердження ревізії лекції
    <a href="<?= Yii::app()->createAbsoluteUrl('revision/previewLectureRevision', array('idRevision' => $revision->id_revision)) ?>">
        Ревізія <?= $revision->id_revision ?>.
    </a>
</span>
<br>
Підтвердити або скасувати запит:
<a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index'); ?>#/admin/requests">
    <em>запити</em>
</a>
