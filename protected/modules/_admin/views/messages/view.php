<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>

<br>
<br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейс сайта - Головна</a>
</button>

<div class="page-header">
<h1>Повідомлення #<?php echo $model->id_record; ?></h1>
</div>
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
<div class="page-header">
<b>Коментар:</b>   <?php echo TranslateComment::getMessageCommentById($model->id);?>
    </div>
<br>
<br>
<div class="page-header">
<b>Категорія:</b>  <?php echo Sourcemessages::getMessageCategory($model->id);?>
</div>
