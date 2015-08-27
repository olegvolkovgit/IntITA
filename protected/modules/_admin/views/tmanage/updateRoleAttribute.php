<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
	'Ролі викладачів'=>array('tmanage/roles'),
	'Атрибут '.$model->name_ua=>array('view','id'=>$model->id),
	'Редагувати',
);
?>

<h1>Редагувати атрибут ролі <?php echo $model->name_ua; ?></h1>

<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>