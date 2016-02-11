<?php
/* @var $this OperationTypeController */
/* @var $model OperationType */
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'negative_summa',
	),
)); ?>
