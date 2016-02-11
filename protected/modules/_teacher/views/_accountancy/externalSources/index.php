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
<button class="btn btn-primary"
        onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/externalSources/create"); ?>',
            'Додати зовнішнє джерело коштів')">Додати
</button>
<br>
<br>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'external-sources-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'summaryText' => '',
    'columns' => array(
        'id',
        'name',
        'cash',
    ),
)); ?>

