<?php
/* @var $this ExternalSourcesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'External Sources',
);

$this->menu=array(
	array('label'=>'Create ExternalSources', 'url'=>array('create')),
	array('label'=>'Manage ExternalSources', 'url'=>array('admin')),
);
?>

<h1>External Sources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'summaryText'=>'',
)); ?>
