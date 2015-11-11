<?php
/* @var $this OperationController */
/* @var $model Operation */
?>

<h1>Операція №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_create',
		'user_create',
		'type_id',
		'invoice_id',
		'summa',
	),
)); ?>
