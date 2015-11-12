<?php
/* @var $this OperationTypeController */
/* @var $model OperationType */
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/operationType/index');?>">Типи операцій - Головна</a>

<h1>Тип операції №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'negative_summa',
	),
)); ?>
