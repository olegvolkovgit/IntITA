<?php
/**
 * @var $model MessagesModuleRevisionRequest
 */
?>
<h4>
    Затвердити ревізію модуля: <a
        href="<?= Yii::app()->createUrl('moduleRevision/previewModuleRevision', array('idRevision' => $model->id_module_revision)); ?>">
        Ревізія №<?= $model->id_module_revision; ?></a>
</h4>
