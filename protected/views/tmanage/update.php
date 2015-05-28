<?php
/* @var $this MytestController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->title=>array('view','id'=>$model->teacher_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список вчителів', 'url'=>array('index')),
	array('label'=>'Додати вчителя', 'url'=>array('create')),
	array('label'=>'Показати вчителя', 'url'=>array('view', 'id'=>$model->teacher_id)),
	array('label'=>'Управління вчителями', 'url'=>array('admin')),
);
?>

<h1>Update Teacher <?php echo $model->teacher_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>