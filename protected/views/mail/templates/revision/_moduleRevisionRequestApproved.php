<?php
/**
 * @var $params array
 * @var $revision RevisionModule
 */
$revision = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Твій запит на затвердження ревізії модуля <strong>
    <a href="<?= Yii::app()->createAbsoluteUrl('moduleRevision/previewModuleRevision', array('idRevision' => $revision->id_module_revision)) ?>"
    target="_blank">
        Ревізія <?= $revision->id_module_revision ?>.
    </a>
</strong> підтверджено.