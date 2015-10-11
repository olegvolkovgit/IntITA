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
        'cancelled',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{view}{update}{delete}{restore}',
            'deleteConfirmation'=>'Ви впевнені, що хочете видалити цей модуль?',
            'headerHtmlOptions'=>array('style'=>'width:100px'),
            'buttons'=>array(
            'restore' => array
            (
                'label'=>'Відновити модуль',
                'url' => 'Yii::app()->createUrl("/_admin/module/restore", array("id"=>$data->primaryKey))',
                'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
                'options'=>array(
                    'class'=>'controlButtons;',
                )
            )),
        ),
    ),
)); ?>