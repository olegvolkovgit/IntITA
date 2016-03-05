<?php
/* @var $this CancelReasonTypeController */
/* @var $model CancelReasonType */

?>

<h1>View CancelReasonType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
