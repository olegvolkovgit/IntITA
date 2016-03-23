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
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/create');?>','Додати фото')">
            Додати фото</button>
    </li>
</ul>

    <div class="page-header">
        <h4>Слайдер на головній</h4>
    </div>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="mainSliderTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>Порядок</th>
                        <th>Фото</th>
                        <th>Вверх</th>
                        <th>Вниз</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        initMainSliderList();
    });
</script>
<?php //$this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'carousel-grid',
//    'dataProvider'=>$model->search(),
//    'summaryText'=>'',
//    'columns'=>array(
//        'order',
//        array(
//            'header'=>'Фото',
//            'value'=>'StaticFilesHelper::createPath("image", "mainpage", $data->pictureURL)',
//            'type'=>'image',
//            'htmlOptions'=>array('id'=>'carouselImage'),
//        ),
//        array(
//            'template'=>'{view}{delete}{up}{down}',
//            'class'=>'CButtonColumn',
//            'headerHtmlOptions'=>array('style'=>'width:120px'),
//            'buttons'=>array(
//                'delete' => array
//                (
//                    'click' => "function(){
//                                    showConfirm('Ви дійсно хочете видалити цей файл?',$(this).attr('href'))
//                                    return false;
//                              }
//                     ",
//                    'label' => 'Видалити',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/delete", array("id"=>$data->id))',
//                ),
//                'up' => array
//                (
//                    'label'=>'Відображення на головній',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/up", array("order"=>$data->order))',
//                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
//                    'options'=>array(
//                        'class'=>'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("carousel-grid");
//                            }'
//                        )
//                    )
//                ),
//                'down' => array
//                (
//                    'label'=>'Відображення на головній',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/down", array("order"=>$data->order))',
//                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
//                    'options'=>array(
//                        'class'=>'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("carousel-grid");
//                            }'
//                        )
//                    )
//                ),
//                'view' => array(
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/carousel/view", array("id"=>$data->id))',
//                    'options' => array(
//                        'class' => 'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(data) {
//                                fillContainer(data);
//                            }'
//                        )
//                    )
//                ),
//            ),
//         ),
//)));
//?>
