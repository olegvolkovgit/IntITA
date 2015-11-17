<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */

$this->breadcrumbs=array(
	'External Sources'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExternalSources', 'url'=>array('index')),
	array('label'=>'Create ExternalSources', 'url'=>array('create')),
	array('label'=>'View ExternalSources', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExternalSources', 'url'=>array('admin')),
);
?>

<h1>Update ExternalSources <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>