<?php
/* @var $this CancelReasonTypeController */
/* @var $model CancelReasonType */

$this->breadcrumbs=array(
	'Cancel Reason Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CancelReasonType', 'url'=>array('index')),
	array('label'=>'Create CancelReasonType', 'url'=>array('create')),
	array('label'=>'View CancelReasonType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CancelReasonType', 'url'=>array('admin')),
);
?>

<h1>Update CancelReasonType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>