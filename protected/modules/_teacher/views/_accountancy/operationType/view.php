<?php
/* @var $this OperationTypeController */
/* @var $model OperationType */
?>

<h1>Тип операції №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'negative_summa',
	),
)); ?>
