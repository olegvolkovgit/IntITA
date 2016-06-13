<?php
/**
 * @var $model MessagesCoworkerRequest
 */
$teacher = $model->teacher();
?>
<h4>
    Призначити співробітником: <a
        href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $teacher->id)); ?>">
        <?= $teacher->userNameWithEmail(); ?></a>
</h4>
