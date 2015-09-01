<?php
/* @var $this ResponseController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#response-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>

<h1>Відгуки про викладачів</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'response-grid',
    'summaryText' => '',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'who',
        'about',
        'date',
        'text',
        'rate',
        'knowledge',
        'behavior',
        'motivation',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
