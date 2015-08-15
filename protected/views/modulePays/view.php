<?php
/* @var $this ModulePaysController */
/* @var $model ModulePayment */

$this->breadcrumbs=array(
	'Module Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ModulePayment', 'url'=>array('index')),
	array('label'=>'Create ModulePayment', 'url'=>array('create')),
	array('label'=>'Update ModulePayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ModulePayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ModulePayment', 'url'=>array('admin')),
);
?>

<h1>View ModulePayment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_date',
		'create_user',
		'acc_user_id',
		'service_id',
		'description',
		'summa',
	),
)); ?>
