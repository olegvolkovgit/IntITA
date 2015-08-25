<?php
/* @var $this GraduateController */
/* @var $model Graduate */

$this->breadcrumbs=array(
	'Graduates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Graduate', 'url'=>array('index')),
	array('label'=>'Create Graduate', 'url'=>array('create')),
	array('label'=>'View Graduate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Graduate', 'url'=>array('admin')),
);
?>

<h1>Update Graduate <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>