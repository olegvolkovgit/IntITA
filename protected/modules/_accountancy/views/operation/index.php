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
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/operation/create');?>">Нова проплата</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/operation/cancel');?>">Відмінити проплату</a>


<h1>Проплати</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'operation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'emptyText'=>'Проплат не знайдено.',
    'summaryText'=>'',
	'columns'=>array(
		'id',
		'date_create',
        array(
            'name' => 'user_create',
            'value' => 'StudentReg::getUserNamePayment($data->user_create)',
        ),
        array(
            'name' => 'type_id',
            'value' => 'OperationType::getDescription($data->type_id)',
        ),
		'summa',
	),
)); ?>
