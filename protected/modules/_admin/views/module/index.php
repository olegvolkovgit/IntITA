<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.09.2015
 * Time: 0:35
 */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/create');?>">Створити модуль</a>

    <h2>Модулі</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'module-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions' => array('class' => 'grid-view custom'),
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
            'value' => 'Module::getCancelledName($data->cancelled)',
        ),
        array(
          'name' => 'status',
            'value' => 'Module::getStatusName($data->status)',
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>'{view}{update}{delete}{restore}{statusUp}{statusDown}',
            'deleteConfirmation'=>'Ви впевнені, що хочете видалити цей модуль?',
            'headerHtmlOptions'=>array('style'=>'width:120px'),
            'buttons'=>array(
            'restore' => array
            (
                'label'=>'Відновити модуль',
                'url' => 'Yii::app()->createUrl("/_admin/module/restore", array("id"=>$data->primaryKey))',
                'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
                'options'=>array(
                    'class'=>'controlButtons;',
                )
            ),
            'statusUp' => array
            (
                'label'=>'Статус модуля',
                'url' => 'Yii::app()->createUrl("/_admin/module/upStatus", array("id"=>$data->primaryKey))',
                'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                'options'=>array(
                    'class'=>'controlButtons;',
                )
            ),
            'statusDown' => array
            (
                'label'=>'Статус модуля',
                'url' => 'Yii::app()->createUrl("/_admin/module/downStatus", array("id"=>$data->primaryKey))',
                'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                'options'=>array(
                    'class'=>'controlButtons;',
                )
            )

            ),
        ),
    ),
)); ?>