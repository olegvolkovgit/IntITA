<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.09.2015
 * Time: 0:35
 */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin'); ?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>

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
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
)); ?>