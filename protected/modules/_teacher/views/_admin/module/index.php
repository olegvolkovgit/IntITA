<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/create'); ?>')">
            Створити модуль</button>
    </li>

</ul>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'module-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
//    'htmlOptions' => array('class' => 'grid-view custom'),
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'summaryText' => '',
    'columns' => array(
        'module_ID',
        'module_number',
        'alias',
        'title_ua',
        'language',
        'module_price',
        'level',
        array(
            'name' => 'cancelled',
            'value' => '$data->cancelledTitle()',
        ),
        array(
            'name' => 'status',
            'value' => '$data->statusTitle()',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{restore}{statusUp}{statusDown}',
            'deleteConfirmation' => "Ви підтверджуєте видалення модуля?",
            'headerHtmlOptions' => array('style' => 'width:120px'),
            'buttons' => array(
                'restore' => array
                (
                    'label' => 'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/restore", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("module-grid");
                            }'
                        )
                    )
                ),
                'statusUp' => array
                (
                    'label' => 'Статус модуля',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/upStatus", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("module-grid");
                            }'
                        )
                    )
                ),
                'statusDown' => array
                (
                    'label' => 'Статус модуля',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/downStatus", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                        'ajax'=>array(
                            'type'=>'get',
                            'url'=>'js:$(this).attr("href")',
                            'success'=>'js:function(response) {
                            $.fn.yiiGridView.update("module-grid");
                            }'
                        )
                    )
                ),
                'view' => array
                (
                    'label' => 'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/view", array("id"=>$data->primaryKey))',
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
                'update' => array
                (
                    'label' => 'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/module/update", array("id"=>$data->primaryKey))',
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
    ),
)); ?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
