<?php
/* @var $this ModulePaysController */
/* @var $model ModulePayment */

$this->breadcrumbs=array(
	'Module Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModulePayment', 'url'=>array('index')),
	array('label'=>'Manage ModulePayment', 'url'=>array('admin')),
);
?>

<h1>Create ModulePayment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>