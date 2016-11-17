<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */

$this->breadcrumbs=array(
	'Mail Templates'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List MailTemplates', 'url'=>array('index')),
	array('label'=>'Create MailTemplates', 'url'=>array('create')),
	array('label'=>'Update MailTemplates', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MailTemplates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MailTemplates', 'url'=>array('admin')),
);
?>

<h1>View MailTemplates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
		'active',
	),
)); ?>
