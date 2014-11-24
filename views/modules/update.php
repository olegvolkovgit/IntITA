<?php
/* @var $this ModulesController */
/* @var $model Modules */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->ModuleID=>array('view','id'=>$model->ModuleID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Modules', 'url'=>array('index')),
	array('label'=>'Create Modules', 'url'=>array('create')),
	array('label'=>'View Modules', 'url'=>array('view', 'id'=>$model->ModuleID)),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);
?>

<h1>Update Modules <?php echo $model->ModuleID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>