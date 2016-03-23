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
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/create');?>','Додати фото')">
                Додати фото</button>
        </li>
    </ul>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="aboutusSliderTable" style="width:100%">
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
            initAboutusSliderList();
        });
    </script>
<?php //$this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'aboutus-slider-grid',
//    'dataProvider'=>$model->search(),
//    //'filter'=>$model,
//    'summaryText'=>'',
//    'columns'=>array(
//        'order',
//        array(
//            'header'=>'Фото',
//            'value'=>'StaticFilesHelper::createPath("image", "aboutus", $data->pictureUrl)',
//            'type'=>'image',
//            'htmlOptions'=>array('id'=>'carouselImage'),
//        ),
//            array(
//                'template'=>'{view}{delete}{up}{down}',
//                'class'=>'CButtonColumn',
//                'headerHtmlOptions'=>array('style'=>'width:120px'),
//                'buttons'=>array(
//                    'delete' => array
//                    (
//                        'click' => "function(){
//                                    showConfirm('Ви дійсно хочете видалити цей слайд?',$(this).attr('href'))
//                                    return false;
//                              }
//                     ",
//                        'label' => 'Видалити',
//                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/delete", array("id"=>$data->image_order))',
//                    ),
//                    'view' => array
//                    (
//                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/view", array("id"=>$data->image_order))',
//                        'options'=>array(
//                            'class'=>'controlButtons;',
//                            'ajax'=>array(
//                                'type'=>'get',
//                                'url'=>'js:$(this).attr("href")',
//                                'success'=>'js:function(data) {
//                                                fillContainer(data);
//                            }'
//                            )
//                        )
//                    ),
//                    'up' => array
//                    (
//                        'label'=>'Вгору по черзі',
//                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/up", array("order"=>$data->order))',
//                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
//                        'options'=>array(
//                            'class'=>'controlButtons;',
//                            'ajax'=>array(
//                                'type'=>'get',
//                                'url'=>'js:$(this).attr("href")',
//                                'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("aboutus-slider-grid");
//                            }'
//                            )
//                        )
//                    ),
//                    'down' => array
//                    (
//                        'label'=>'Вниз по черзі',
//                        'url' => 'Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/down", array("order"=>$data->order))',
//                        'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
//                        'options'=>array(
//                            'class'=>'controlButtons;',
//                            'ajax'=>array(
//                                'type'=>'get',
//                                'url'=>'js:$(this).attr("href")',
//                                'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("aboutus-slider-grid");
//                            }'
//                            )
//                        )
//                    ),
//                ),
//            ),
//    ),
//)); ?>