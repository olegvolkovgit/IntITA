<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Ролі викладачів'=>array('tmanage/index'),
	'Роль '.$model->title_ua=>array('view','id'=>$model->id),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Список ролей', 'url'=>array('tmanage/roles')),
);
?>

<h1> Редагувати роль <?php echo $model->title_ua; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>