<?php
/* @var $this CarouselController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#carousel-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminSlider.css" />
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/carousel/create');?>">Додати фото</a>

<h1>Слайдер на головній</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'carousel-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'columns'=>array(
        'order',
        array(
            'header'=>'Фото',
            'value'=>'StaticFilesHelper::createPath("image", "mainpage", $data->pictureURL)',
            'type'=>'image',
            'htmlOptions'=>array('id'=>'carouselImage'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
