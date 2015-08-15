<?php
/* @var $this ExternalPaysController */
/* @var $model ExternalPays */

$this->breadcrumbs=array(
	'External Pays'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExternalPays', 'url'=>array('index')),
	array('label'=>'Manage ExternalPays', 'url'=>array('admin')),
);
?>

<h1>Create ExternalPays</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>