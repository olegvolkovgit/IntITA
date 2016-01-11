<?php
/* @var $this ConfigController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>

<br>
<div class="page-header">
    <h1>Налаштування</h1>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'config-grid',
    'summaryText' => '',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'param',
        'value',
        'default',
        'label',
        'type',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
)); ?>

