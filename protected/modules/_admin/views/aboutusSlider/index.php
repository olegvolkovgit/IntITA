<?php
/* @var $this AboutusSliderController */
/* @var $dataProvider CActiveDataProvider */
?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminSlider.css" />
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/create');?>">Додати фото</a>

<h1>Слайдер на сторінці <i>Про нас</i></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'aboutus-slider-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'columns'=>array(
        'image_order',
        array(
            'header'=>'Фото',
            'value'=>'StaticFilesHelper::createPath("image", "aboutus", $data->pictureUrl)',
            'type'=>'image',
            'htmlOptions'=>array('id'=>'carouselImage'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>