<?php
/* @var $this OperationController */
/* @var $model Operation */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#operation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Операції</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'operation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'emptyText'=>'Операцій не знайдено.',
    'summaryText'=>'',
	'columns'=>array(
		'id',
		'date_create',
		'user_create',
		'type_id',
		'invoice_id',
		'summa',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
