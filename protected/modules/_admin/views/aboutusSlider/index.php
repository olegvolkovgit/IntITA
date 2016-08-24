<?php
/* @var $this AboutusSliderController */
/* @var $dataProvider CActiveDataProvider */
?>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/create');?>">Додати фото</a>

    <div class="page-header">
        <h1>Слайдер на сторінці <i>Про нас</i></h1>
    </div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'aboutus-slider-grid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'summaryText'=>'',
    'columns'=>array(
        'order',
        array(
            'header'=>'Фото',
            'value'=>'StaticFilesHelper::createPath("image", "aboutus", $data->pictureUrl)',
            'type'=>'image',
            'htmlOptions'=>array('id'=>'carouselImage'),
        ),
            array(
                'template'=>'{view}{delete}{up}{down}',
                'deleteConfirmation'=>'Ви впевнені, що хочете видалити цей слайд?',
                'class'=>'CButtonColumn',
                'headerHtmlOptions'=>array('style'=>'width:120px'),
                'buttons'=>array(
                    'up' => array
                    (
                        'label'=>'Вгору по черзі',
                        'url' => 'Yii::app()->createUrl("/_admin/aboutusSlider/up", array("order"=>$data->order))',
                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                        'options'=>array(
                            'class'=>'controlButtons;',
                        )
                    ),
                    'down' => array
                    (
                        'label'=>'Вниз по черзі',
                        'url' => 'Yii::app()->createUrl("/_admin/aboutusSlider/down", array("order"=>$data->order))',
                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                        'options'=>array(
                            'class'=>'controlButtons;',
                        )
                    ),
                ),
            ),
    ),
)); ?>