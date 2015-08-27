<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
	'Ролі викладачів'=>array('tmanage/roles'),
	'Атрибут '.$model->name_ua=>array('view','id'=>$model->id),
	'Редагувати',
);

//$this->menu=array(
//	array('label'=>'List RoleAttribute', 'url'=>array('index')),
//	array('label'=>'Create RoleAttribute', 'url'=>array('create')),
//	array('label'=>'View RoleAttribute', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage RoleAttribute', 'url'=>array('admin')),
//);
?>

<h1>Редагувати атрибут ролі <?php echo $model->name_ua; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>