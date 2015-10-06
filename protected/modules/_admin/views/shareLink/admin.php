<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */

$this->breadcrumbs=array(
	'Share Links'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ShareLink', 'url'=>array('index')),
	array('label'=>'Create ShareLink', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#share-link-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Share Links</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'summaryText'=>'',
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'link',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
