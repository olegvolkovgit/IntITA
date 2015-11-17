<?php
/* @var $this CarouselController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminSlider.css" />
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/carousel/create');?>">Додати фото</a>

<h1>Слайдер на головній</h1>


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
            'buttons'=>array(
                'up' => array
                (
                    'label'=>'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_admin/carousel/up", array("order"=>$data->order))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                    )
                ),
                'down' => array
                (
                    'label'=>'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_admin/carousel/down", array("order"=>$data->order))',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options'=>array(
                        'class'=>'controlButtons;',
                    )
                ),
            ),
         ),
)));
?>
