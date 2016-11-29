<?php
/* @var $this SchedulerTasksController */
/* @var $model SchedulerTasks */

$this->breadcrumbs=array(
	'Scheduler Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SchedulerTasks', 'url'=>array('index')),
	array('label'=>'Create SchedulerTasks', 'url'=>array('create')),
	array('label'=>'View SchedulerTasks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SchedulerTasks', 'url'=>array('admin')),
);
?>

<h1>Update SchedulerTasks <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>