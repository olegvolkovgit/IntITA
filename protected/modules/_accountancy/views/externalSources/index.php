<?php
/* @var $this ExternalSourcesController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#external-sources-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/externalSources/create');?>">Додати</a>

<h1>Зовнішні джерела коштів</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'external-sources-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'columns'=>array(
        'id',
        'name',
        'cash',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
