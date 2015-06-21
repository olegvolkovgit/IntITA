<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
	'Role Attributes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleAttribute', 'url'=>array('index')),
	array('label'=>'Manage RoleAttribute', 'url'=>array('admin')),
);
?>

<h1>Create RoleAttribute</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>