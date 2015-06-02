<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Курси'=>array('index'),
	$model->course_ID,
);

$this->menu=array(
	array('label'=>'Список курсів', 'url'=>array('index')),
	array('label'=>'Створити курс', 'url'=>array('create')),
	array('label'=>'Оновити курс', 'url'=>array('update', 'id'=>$model->course_ID)),
	array('label'=>'Видалити курс', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->course_ID),'confirm'=>'Ви впевнені?')),
	array('label'=>'Управління курсами', 'url'=>array('admin')),
);
?>

<h1>Курс <?php echo $model->course_name; ?></h1>

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
