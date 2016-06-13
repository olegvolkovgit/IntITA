<?php
/**
 * @var $params array
 * @var $revision RevisionLecture
 */
$revision = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Ваш запит на затвердження ревізії лекції <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('revision/previewLectureRevision', array('idRevision' => $revision->id_revision)) ?>"
    target="_blank">
        Ревізія <?= $revision->id_revision ?>.
    </a>
</strong> підтверджено.