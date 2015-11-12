<?php
/* @var $this OperationTypeController */
/* @var $model OperationType */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#operation-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/operationType/create');?>">Додати операцію</a>

<h1>Типи операцій</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'operation-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'summaryText'=>'',
    'emptyText'=>'Типів операцій не знайдено.',
	'columns'=>array(
		'id',
		'description',
		'negative_summa',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
