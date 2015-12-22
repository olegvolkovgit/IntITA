<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tmanage',
    'enablePagination' => true,
    'ajaxUpdate' => true,
    'dataProvider' => $model->search(),
    'summaryText' => '',
    'htmlOptions' => array(),
    'pager' => array(
//        'class' => 'pagination',
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => StaticFilesHelper::fullPathTo('css', 'pager.css'),
    ),
    'columns' => array(
        array(
            'header' => 'ПІБ',
            'value' => '"{$data->last_name} {$data->first_name} {$data->middle_name}"',
        ),

        'email',
        array(
            'header' => 'Статус',
            'value' => '($data->isPrint == 1)?"активний":"видалено"',
        ),
    ),
)); ?>