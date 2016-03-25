<?php
if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs=array(Yii::t('activeemail','0311'));
?>
<?php
$url = array('/site/reactivation');
?>
<div class='infoblock'>
<h2><?php echo Yii::t('activeemail','0312') ?></h2>
<?php echo Yii::t('activeemail','0802').' '.CHtml::link(Yii::t('activeemail','0803'),$url,array('submit' => $url,'params' => array('email' => $email))).' '.Yii::t('activeemail','0804').' '.$email; ?>
</div>