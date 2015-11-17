<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */
?>

<h1>View ExternalSources #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'cash',
	),
)); ?>
