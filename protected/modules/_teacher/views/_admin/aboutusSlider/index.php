<?php
/* @var $this AboutusSliderController */
/* @var $dataProvider CActiveDataProvider */
?>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/create');?>')">
                Додати фото</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Слайдер на сторінці <i>Про нас</i></h4>
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
                'deleteConfirmation'=>'Ви впевнені, що хочете видалити цей модуль?',
                'class'=>'CButtonColumn',
                'headerHtmlOptions'=>array('style'=>'width:120px'),
                'buttons'=>array(
                    'view' => array
                    (
                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/view", array("id"=>$data->order))',
                        'options'=>array(
                            'class'=>'controlButtons;',
                            'ajax'=>array(
                                'type'=>'get',
                                'url'=>'js:$(this).attr("href")',
                                'success'=>'js:function(data) {
                                                fillContainer(data);
                            }'
                            )
                        )
                    ),
                    'up' => array
                    (
                        'label'=>'Вгору по черзі',
                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/up", array("order"=>$data->order))',
                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                        'options'=>array(
                            'class'=>'controlButtons;',
                            'ajax'=>array(
                                'type'=>'get',
                                'url'=>'js:$(this).attr("href")',
                                'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("aboutus-slider-grid");
                            }'
                            )
                        )
                    ),
                    'down' => array
                    (
                        'label'=>'Вниз по черзі',
                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/down", array("order"=>$data->order))',
                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                        'options'=>array(
                            'class'=>'controlButtons;',
                            'ajax'=>array(
                                'type'=>'get',
                                'url'=>'js:$(this).attr("href")',
                                'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("aboutus-slider-grid");
                            }'
                            )
                        )
                    ),
                ),
            ),
    ),
)); ?>