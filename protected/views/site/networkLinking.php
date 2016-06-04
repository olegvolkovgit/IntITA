<?php

if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs=array(Yii::t('activeemail','0303'));

?>
<div class='infoblock'>
    <?php echo Yii::t('activeemail','0860') . ' ' . $email . ' ' .Yii::t('activeemail','0861').' '.$network.' '.Yii::t('activeemail','0862') ?>
</div>
