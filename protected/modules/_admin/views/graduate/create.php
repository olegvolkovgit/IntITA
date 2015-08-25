<?php
/* @var $this GraduateController */
/* @var $model Graduate */

$this->breadcrumbs=array(
	'Graduates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Graduate', 'url'=>array('index')),
	array('label'=>'Manage Graduate', 'url'=>array('admin')),
);
?>

<h1>Create Graduate</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>