<?php
/**
 * @var $model MessagesRevisionRequest
 */
?>
<h4>
    Затвердити ревізію лекції: <a
        href="<?= Yii::app()->createUrl('revision/previewLectureRevision', array('idRevision' => $model->id_revision)); ?>">
        Ревізія №<?= $model->id_revision; ?></a>
</h4>
