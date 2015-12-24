<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>
<div class="col-md-12">
    <br>
    <br>

    <ul class="list-inline">
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/create'); ?>')">Додати викладача</a>
        </li>
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/roles'); ?>')">
                Управління ролями викладачів</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>Викладачі</h2>
    </div>
<?php
$this->widget('application.components.MyGridView', array(
    'id' => 'tmanage',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'summaryText' => '',
    'pager' => array(
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

