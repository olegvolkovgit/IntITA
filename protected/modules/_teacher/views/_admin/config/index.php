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
//    'filter' => $model,
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
            'buttons' => array(
                'view' => array(

                    'label' => 'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/config/view", array("id"=>$data->primaryKey))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
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
                'update' => array(
                    'label' => 'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/config/update", array("id"=>$data->primaryKey))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
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

