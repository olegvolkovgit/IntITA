<?php
/**
 * @var $params array
 * @var $user StudentReg
 * @var $revision RevisionLecture
 * @var $comment string
 */
$user = $params[0];
$revision = $params[1];
$comment = $params[2];
?>
Ваша ревізія № <a href="<?=Yii::app()->createAbsoluteUrl('revision/previewLectureRevision', array('idRevision' => $revision->id_revision));?>"
 target="_blank">
    <?=$revision->id_revision;?>
</a>
відхилена користувачем <?=$user->userNameWithEmail();?> <?php if($comment){?>
з таким коментарем <q><?=$comment;?></q>
<?php }?>.
Переглянути відхилені зміни можна за посиланням
<a href="<?=Yii::app()->createAbsoluteUrl('revision/previewLectureRevision', array('idRevision' => $revision->id_revision));?>"
   target="_blank">Ревізія</a>.


