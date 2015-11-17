<?php
/* @var $this CancelReasonTypeController */
/* @var $model CancelReasonType */

$this->breadcrumbs=array(
	'Cancel Reason Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CancelReasonType', 'url'=>array('index')),
	array('label'=>'Create CancelReasonType', 'url'=>array('create')),
	array('label'=>'Update CancelReasonType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CancelReasonType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CancelReasonType', 'url'=>array('admin')),
);
?>

<h1>View CancelReasonType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
