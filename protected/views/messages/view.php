<?php
/* @var $this MessagesController */
/* @var $model Messages */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_record,
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Create Messages', 'url'=>array('create')),
	array('label'=>'Update Messages', 'url'=>array('update', 'id'=>$model->id_record)),
	array('label'=>'Delete Messages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_record),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);
?>

<h1>View Messages #<?php echo $model->id_record; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_record',
		'id',
		'language',
		'translation',
	),
)); ?>
