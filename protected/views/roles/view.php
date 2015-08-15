<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список ролей', 'url'=>array('tmanage/roles')),
);
?>

<h1>View Roles #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title_en',
		'title_ru',
		'title_ua',
		'description',
	),
)); ?>
