<?php
/* @var $this ModulePaysController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Module Payments',
);

$this->menu=array(
	array('label'=>'Create ModulePayment', 'url'=>array('create')),
	array('label'=>'Manage ModulePayment', 'url'=>array('admin')),
);
?>

<h1>Module Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
