<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
<br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/shareLink/index');?>">Перегляд посиланнь на ресурси</a>
</button>
<br>

<div class="page-header">
<h1>Управління ресурсами для викладачів №<?php echo $model->id; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'link',
	),
)); ?>
