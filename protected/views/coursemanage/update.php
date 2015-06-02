<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Курси'=>array('index'),
	$model->course_ID=>array('view','id'=>$model->course_ID),
	'Оновити',
);

$this->menu=array(
	array('label'=>'Список курсів', 'url'=>array('index')),
	array('label'=>'Створити курс', 'url'=>array('create')),
	array('label'=>'Показати курс', 'url'=>array('view', 'id'=>$model->course_ID)),
	array('label'=>'Управління курсами', 'url'=>array('admin')),
);
?>

<h1>Оновити курс <?php echo $model->course_ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>