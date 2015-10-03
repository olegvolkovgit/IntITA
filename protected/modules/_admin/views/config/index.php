<?php
/* @var $this ConfigController */
/* @var $dataProvider CActiveDataProvider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

<br>

<h1>Налаштування</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'config-grid',
    'summaryText' => '',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'param',
        'value',
        'default',
        'label',
        'type',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),
    ),
)); ?>

