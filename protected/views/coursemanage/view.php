<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->course_ID,
);

$this->menu=array(
	array('label'=>'List Course', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Update Course', 'url'=>array('update', 'id'=>$model->course_ID)),
	array('label'=>'Delete Course', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->course_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>View Course #<?php echo $model->course_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'course_ID',
		'alias',
		'language',
		'course_name',
		'level',
		'start',
		'status',
		'modules_count',
		'course_duration_hours',
		'course_price',
		'for_whom',
		'what_you_learn',
		'what_you_get',
		'course_img',
		'review',
	),
)); ?>
