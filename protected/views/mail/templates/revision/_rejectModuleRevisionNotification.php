<?php
/**
 * @var $params array
 * @var $user StudentReg
 * @var $revision RevisionModule
 * @var $comment string
 */
$user = $params[0];
$revision = $params[1];
$comment = $params[2];
?>
Твоя ревізія модуля № <a href="<?=Yii::app()->createAbsoluteUrl('moduleRevision/previewModuleRevision', array('idRevision' => $revision->id_module_revision));?>"
 target="_blank">
    <?=$revision->id_module_revision;?>
</a>
відхилена користувачем <?=$user->userNameWithEmail();?> <?php if($comment){?>
з таким коментарем <q><?=$comment;?></q>
<?php }?>.
Переглянути відхилені зміни можна за посиланням
<a href="<?=Yii::app()->createAbsoluteUrl('moduleRevision/previewModuleRevision', array('idRevision' => $revision->id_module_revision));?>"
   target="_blank">Ревізія</a>.


