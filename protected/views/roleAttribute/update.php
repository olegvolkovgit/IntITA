<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
	'Role Attributes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleAttribute', 'url'=>array('index')),
	array('label'=>'Create RoleAttribute', 'url'=>array('create')),
	array('label'=>'View RoleAttribute', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleAttribute', 'url'=>array('admin')),
);
?>

<h1>Update RoleAttribute <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>