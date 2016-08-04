<?php
/**
 * @var $model MessagesTeacherConsultantRequest
 */
?>
<h4>
    Викладач-консультант: <a
        href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $model->idTeacher->id)); ?>"
        target="_blank">
        <?= $model->idTeacher->userNameWithEmail(); ?>
    </a>
</h4>