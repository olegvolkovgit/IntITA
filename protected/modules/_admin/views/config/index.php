<?php
/* @var $this ConfigController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Create Config', 'url'=>array('create')),
	array('label'=>'Manage Config', 'url'=>array('admin')),
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

<h1>Configs</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'configs',
	'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom','id'=>'config-form'),
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>'Параметр',
            'value'=>'$data->param',
        ),
        array(
            'header'=>'Значення',
            'value'=>'$data->value',
        ),
        array(
            'value' => '$data->default',
            'header'=>'За замовчуванням'
        ),
        array(
            'header'=>'Опис',
            'value'=>'$data->label',
        ),
    ),
)); ?>
