<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */

$this->breadcrumbs=array(
	'Share Links'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShareLink', 'url'=>array('index')),
	array('label'=>'Create ShareLink', 'url'=>array('create')),
	array('label'=>'View ShareLink', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ShareLink', 'url'=>array('admin')),
);
?>

<h1>Update ShareLink <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>