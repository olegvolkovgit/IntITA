<?php
/* @var $this ModulePaysController */
/* @var $model ModulePayment */

$this->breadcrumbs=array(
	'Module Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModulePayment', 'url'=>array('index')),
	array('label'=>'Create ModulePayment', 'url'=>array('create')),
	array('label'=>'View ModulePayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ModulePayment', 'url'=>array('admin')),
);
?>

<h1>Update ModulePayment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>