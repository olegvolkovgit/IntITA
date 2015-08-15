<?php
/* @var $this ExternalPaysController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'External Pays',
);

$this->menu=array(
	array('label'=>'Create ExternalPays', 'url'=>array('create')),
	array('label'=>'Manage ExternalPays', 'url'=>array('admin')),
);
?>

<h1>External Pays</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'summaryText' => ''
)); ?>
