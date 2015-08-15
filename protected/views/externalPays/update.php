<?php
/* @var $this ExternalPaysController */
/* @var $model ExternalPays */

$this->breadcrumbs=array(
	'External Pays'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExternalPays', 'url'=>array('index')),
	array('label'=>'Create ExternalPays', 'url'=>array('create')),
	array('label'=>'View ExternalPays', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExternalPays', 'url'=>array('admin')),
);
?>

<h1>Update ExternalPays <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>