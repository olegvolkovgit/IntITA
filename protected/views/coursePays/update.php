<?php
/* @var $this CoursePaysController */
/* @var $model CoursePayment */

$this->breadcrumbs=array(
	'Course Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CoursePayment', 'url'=>array('index')),
	array('label'=>'Create CoursePayment', 'url'=>array('create')),
	array('label'=>'View CoursePayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CoursePayment', 'url'=>array('admin')),
);
?>

<h1>Update CoursePayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>