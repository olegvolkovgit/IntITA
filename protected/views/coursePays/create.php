<?php
/* @var $this CoursePaysController */
/* @var $model CoursePayment */

$this->breadcrumbs=array(
	'Course Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CoursePayment', 'url'=>array('index')),
	array('label'=>'Manage CoursePayment', 'url'=>array('admin')),
);
?>

<h1>Create CoursePayment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>