<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */

$this->breadcrumbs=array(
	'External Sources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExternalSources', 'url'=>array('index')),
	array('label'=>'Manage ExternalSources', 'url'=>array('admin')),
);
?>

<h1>Create ExternalSources</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>