<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */

$this->menu=array(
	array('label'=>'List ShareLink', 'url'=>array('index')),
	array('label'=>'Create ShareLink', 'url'=>array('create')),
	array('label'=>'Update ShareLink', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ShareLink', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShareLink', 'url'=>array('admin')),
);
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
