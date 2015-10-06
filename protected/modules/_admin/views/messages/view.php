<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>

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
<br>
<b>Коментар:</b>   <?php echo MessagesHelper::getMessageCommentById($model->id);?>
<br>
<br>
<b>Категорія:</b>  <?php echo MessagesHelper::getMessageCategory($model->id);?>

