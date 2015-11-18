<?php
/* @var $this CancelReasonTypeController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cancel-reason-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/cancelReasonType/create');?>">Додати</a>

<h1>Причини відміни операцій</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'cancel-reason-type-grid',
    'dataProvider'=>$model->search(),
    'summaryText'=>'',
    'filter'=>$model,
    'columns'=>array(
        'id',
        'description',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
