<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
	'Role Attributes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RoleAttribute', 'url'=>array('index')),
	array('label'=>'Create RoleAttribute', 'url'=>array('create')),
	array('label'=>'Update RoleAttribute', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoleAttribute', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleAttribute', 'url'=>array('admin')),
);
?>

<h1>View RoleAttribute #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'role',
		'type',
		'name_ru',
		'name_ua',
	),
)); ?>
