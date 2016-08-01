<?php
/**
 * @var $params array
 * @var $revision RevisionLecture
 */
$revision = $params[0];
?>
<h4>Повідомлення</h4>
<br>
Твій запит на затвердження ревізії лекції <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('revision/previewLectureRevision', array('idRevision' => $revision->id_revision)) ?>"
    target="_blank">
        Ревізія <?= $revision->id_revision ?>.
    </a>
</strong> відхилено.
<br>
Зв'язатися з контент менеджером: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' =>  $revision->properties->id_user
)); ?>">написати контент менеджеру</a>.