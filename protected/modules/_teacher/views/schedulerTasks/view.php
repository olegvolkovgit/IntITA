<?php
/* @var $this SchedulerTasksController */
/* @var $model SchedulerTasks */

$this->breadcrumbs=array(
	'Scheduler Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SchedulerTasks', 'url'=>array('index')),
	array('label'=>'Create SchedulerTasks', 'url'=>array('create')),
	array('label'=>'Update SchedulerTasks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SchedulerTasks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SchedulerTasks', 'url'=>array('admin')),
);
?>

<h1>View SchedulerTasks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'repeat',
		'start_time',
		'end_time',
		'parameters',
		'status',
		'error',
	),
)); ?>
