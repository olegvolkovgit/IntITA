<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
<br>
<a href="#" onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index');?>')">Перегляд посиланнь на ресурси</a>
<br>

<div class="page-header">
<h1>Управління ресурсами для викладачів № <?php echo $model->id; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'link',
	),
)); ?>
