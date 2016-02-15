<?php
/* @var $model Translate */
?>

<?php //$this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'translate-grid',
//    'dataProvider'=>$model->search(),
//    'summaryText'=>'',
//    'filter' => $model,
//    'pager' => array(
//        'firstPageLabel'=>'&#171;&#171;',
//        'lastPageLabel'=>'&#187;&#187;',
//        'prevPageLabel'=>'&#171;',
//        'nextPageLabel'=>'&#187;',
//        'header'=>'',
//        'cssFile'=> StaticFilesHelper::fullPathTo('css', 'pager.css'),
//    ),
//    'columns'=>array(
//        'id',
//        'language',
//        array(
//            'header' => 'Категорія',
//            'value' => '$data->source->category',
//        ),
//        'translation',
//        array(
//            'header' => 'Коментар',
//            'value' => 'MessageComment::getMessageCommentById($data->id)',
//        ),
//        array(
//            'class'=>'CButtonColumn',
//            'template'=>'{view}{update}',
//            'buttons' => array(
//                'view' => array(
//                    'label' => 'Переглянути',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/translate/view", array("id"=>$data->primaryKey))',
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
//                'update' => array(
//                    'label' => 'Редагувати',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/translate/update", array("id"=>$data->primaryKey))',
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
//        ),
//    ),
//)); ?>
<div class="col-lg-12">
    <button class="btn btn-primary" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/create');?>',
        'Додати повідомлення')">
        Додати повідомлення
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="translatesTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Мова</th>
                        <th>Категорія</th>
                        <th>Переклад</th>
                        <th>Коментар</th>
                        <th>Управління</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/translatesList.js'); ?>"></script>
<script>
    $jq(document).ready(function () {
        translatesTable = initTranslatesList();
    });
</script>
