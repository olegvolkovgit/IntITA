<?php
/* @var $models Teacher */
/* @var $paginator Paginator */

?>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>
<div class="col-md-12">
    <br>
    <br>

    <ul class="list-inline">
        <li>
        <a href="#" ng-click='ngLoad("<?php echo Yii::app()->createUrl('/_admin/tmanage/create'); ?>")'>Додати викладача</a>
        </li>
        <li>
        <a href="#" ng-click='ngLoad("<?php echo Yii::app()->createUrl('/_admin/tmanage/roles'); ?>")'>
            Управління ролями викладачів</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>Викладачі</h2>
    </div>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'htmlOptions' => array('class' => 'grid-view custom', 'id' => 'adminTeacherList'),
    'summaryText' => 'Показано викладачів {start} - {end} з {count}',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'columns' => array(
        array(
            'header' => 'ПІБ',
            'value' => '"{$data->last_name} {$data->first_name} {$data->middle_name}"',
        ),
        array(
            'class' => 'CLinkColumn',
            'label' => 'Ролі викладача',
            'urlExpression' => 'Yii::app()->createUrl("/_admin/tmanage/showRoles", array("id"=>$data->teacher_id))',
            'header' => 'Ролі'
        ),
        'email',
        array(
            'header' => 'Статус',
            'value' => '($data->isPrint == 1)?"активний":"видалено"',
        ),
    ),
)); ?>
</div>

