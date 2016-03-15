<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/create'); ?>',
                    'Створити модуль')">
            Створити модуль</button>
    </li>
</ul>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="modulesTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Псевдонім</th>
                        <th>Мова</th>
                        <th>Назва</th>
                        <th>Статус</th>
                        <th>Рівень</th>
                        <th>Видалений</th>
                        <th>Призначити</th>
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
        initModules();
    });
</script>


<!---->
<!---->
<?php //$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'module-grid',
//    'dataProvider' => $model->search(),
//    'pager' => array(
//        'firstPageLabel' => '&#171;&#171;',
//        'lastPageLabel' => '&#187;&#187;',
//        'prevPageLabel' => '&#171;',
//        'nextPageLabel' => '&#187;',
//        'header' => '',
//        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
//    ),
//    'summaryText' => '',
//    'columns' => array(
//        'module_ID',
//        'module_number',
//        'alias',
//        'title_ua',
//        'language',
//        'module_price',
//        'level',
//        array(
//            'name' => 'cancelled',
//            'value' => '$data->cancelledTitle()',
//        ),
//        array(
//            'name' => 'status',
//            'value' => '$data->statusTitle()',
//        ),
//        array(
//            'class' => 'CButtonColumn',
//            'template' => '{view}{update}{delete}{restore}{statusUp}{statusDown}',
//            'headerHtmlOptions' => array('style' => 'width:120px'),
//            'buttons' => array(
//                'delete' => array
//                (
//                    'click' => "function(){
//                                    moduleCancelled('Ви дійсно хочете видалити цей модуль?',$(this).attr('href'))
//                                    return false;
//                              }
//                     ",
//                    'label' => 'Видалити',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/delete", array("id"=>$data->primaryKey))',
//                ),
//                'restore' => array
//                (
//                    'label' => 'Відновити модуль',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/restore", array("id"=>$data->primaryKey))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
//                    'options' => array(
//                        'class' => 'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("module-grid");
//                            }'
//                        )
//                    )
//                ),
//                'statusUp' => array
//                (
//                    'label' => 'Статус модуля',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/upStatus", array("id"=>$data->primaryKey))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'down.png'),
//                    'options' => array(
//                        'class' => 'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("module-grid");
//                            }'
//                        )
//                    )
//                ),
//                'statusDown' => array
//                (
//                    'label' => 'Статус модуля',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/downStatus", array("id"=>$data->primaryKey))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'up.png'),
//                    'options' => array(
//                        'class' => 'controlButtons;',
//                        'ajax'=>array(
//                            'type'=>'get',
//                            'url'=>'js:$(this).attr("href")',
//                            'success'=>'js:function(response) {
//                            $.fn.yiiGridView.update("module-grid");
//                            }'
//                        )
//                    )
//                ),
//                'view' => array
//                (
//                    'label' => 'Переглянути модуль',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/view", array("id"=>$data->primaryKey))',
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
//                'update' => array
//                (
//                    'label' => 'Редагувати модуль',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/update", array("id"=>$data->primaryKey))',
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
