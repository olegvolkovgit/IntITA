<?php
/* @var $this CarouselController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<br>
<br>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/create');?>')">
            Додати фото</button>
    </li>
</ul>

    <div class="page-header">
        <h4>Слайдер на головній</h4>
    </div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'carousel-grid',
    'dataProvider'=>$model->search(),
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
            'template'=>'{view}{delete}{up}{down}',
            'deleteConfirmation'=>'Ви впевнені, що хочете видалити цей модуль?',
            'class'=>'CButtonColumn',
            'headerHtmlOptions'=>array('style'=>'width:120px'),
            'buttons'=>array(
                'up' => array
                (
                    'label'=>'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/up", array("order"=>$data->order))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("carousel-grid");
                            }'
                        )
                    )
                ),
                'down' => array
                (
                    'label'=>'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/down", array("order"=>$data->order))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("carousel-grid");
                            }'
                        )
                    )
                ),
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/view", array("id"=>$data->id))',
                    'options' => array(
                        'class' => 'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(data) {
                                fillContainer(data);
                            }'
                        )
                    )
                ),
            ),
         ),
)));
?>
