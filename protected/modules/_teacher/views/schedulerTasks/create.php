<?php
/* @var $this SchedulerTasksController */
/* @var $model SchedulerTasks */

$this->breadcrumbs=array(
	'Scheduler Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchedulerTasks', 'url'=>array('index')),
	array('label'=>'Manage SchedulerTasks', 'url'=>array('admin')),
);
?>

<h1>Create SchedulerTasks</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>