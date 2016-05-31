<?php
if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs = array(Yii::t('activeemail', '0303'));
?>
<div class='infoblock'>
    <?php echo Yii::t('activeemail','0863') . ' ' . $email . ' ' . Yii::t('activeemail','0864').' '.$network ?>
</div>