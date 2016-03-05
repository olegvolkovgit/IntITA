<?php
/* @var $this CancelReasonTypeController */
/* @var $model CancelReasonType */

?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
