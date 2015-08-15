<?php
/* @var $this ExternalPaysController */
/* @var $model ExternalPays */

$this->breadcrumbs=array(
	'External Pays'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExternalPays', 'url'=>array('index')),
	array('label'=>'Create ExternalPays', 'url'=>array('create')),
	array('label'=>'Update ExternalPays', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExternalPays', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExternalPays', 'url'=>array('admin')),
);
?>

<h1>View ExternalPays #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_date',
		'create_user',
		'source_id',
		'user_id',
		'pay_date',
		'summa',
		'description',
	),
)); ?>
