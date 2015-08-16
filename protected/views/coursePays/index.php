<?php
/* @var $this CoursePaysController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Payments',
);

$this->menu=array(
	array('label'=>'Create CoursePayment', 'url'=>array('create')),
	array('label'=>'Manage CoursePayment', 'url'=>array('admin')),
);
?>

<h1>Course Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'summaryText'=>'',
	'itemView'=>'_view',
)); ?>
