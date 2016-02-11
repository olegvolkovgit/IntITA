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
<button class="btn btn-primary"
        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountancy/cancelReasonType/create');?>',
            'Додати причину відміни проплат')">Додати
</button>
<br>
<br>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'cancel-reason-type-grid',
    'dataProvider'=>$model->search(),
    'summaryText'=>'',
    'filter'=>$model,
    'columns'=>array(
        'id',
        'description',
    ),
)); ?>
