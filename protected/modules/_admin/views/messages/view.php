<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>

<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейс сайта - Головна</a>

<h1>Повідомлення #<?php echo $model->id_record; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_record',
		'id',
		'language',
		'translation',
	),
)); ?>
