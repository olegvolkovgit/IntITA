<?php
if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs = array(Yii::t('activeemail', '0303'));
?>
<div class='infoblock'>
    <h2><?php echo Yii::t('activeemail', '0306') ?></h2>
    <?php echo Yii::t('activeemail', '0307') . ' ' . $email . ' ' . Yii::t('activeemail', '0308') ?>
</div>