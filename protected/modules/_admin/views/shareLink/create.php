<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */

//$this->breadcrumbs=array(
//	'Share Links'=>array('index'),
//	'Create',
//);

$this->menu=array(
	array('label'=>'List ShareLink', 'url'=>array('index')),
	array('label'=>'Manage ShareLink', 'url'=>array('admin')),
);
?>

<h1>Створити посилання для викладачів</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>