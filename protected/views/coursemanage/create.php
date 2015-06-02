<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Курси'=>array('index'),
	'Створити',
);

$this->menu=array(
	array('label'=>'Список курсів', 'url'=>array('index')),
	array('label'=>'Управління курсами', 'url'=>array('admin')),
);
?>

<h1>Створити курс</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>