<?php
/* @var $this CoursePaysController */
/* @var $model CoursePayment */

$this->breadcrumbs=array(
	'Course Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CoursePayment', 'url'=>array('index')),
	array('label'=>'Create CoursePayment', 'url'=>array('create')),
	array('label'=>'Update CoursePayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CoursePayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CoursePayment', 'url'=>array('admin')),
);
?>

<h1>View CoursePayment #<?php echo $model->id; ?></h1>

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
