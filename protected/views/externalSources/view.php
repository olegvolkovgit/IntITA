<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */

$this->breadcrumbs=array(
	'External Sources'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List ExternalSources', 'url'=>array('index')),
	array('label'=>'Create ExternalSources', 'url'=>array('create')),
	array('label'=>'Update ExternalSources', 'url'=>array('update', 'id'=>$model->source_id)),
	array('label'=>'Delete ExternalSources', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->source_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExternalSources', 'url'=>array('admin')),
);
?>

<h1>View ExternalSources #<?php echo $model->source_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'source_id',
		'Name',
		'cash',
	),
)); ?>
