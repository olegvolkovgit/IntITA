
<?php
if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));

$this->pageTitle = 'INTITA';
?>
<?php
$this->breadcrumbs=array(Yii::t('activeemail','0311'));
?>
<div class='infoblock'>
<h2><?php echo Yii::t('activeemail','0312') ?></h2>
<?php echo Yii::t('activeemail','0313').' '.$email; ?>
</div>