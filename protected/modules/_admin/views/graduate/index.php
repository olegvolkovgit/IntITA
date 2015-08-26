<?php
/* @var $this GraduateController */
/* @var $dataProvider CActiveDataProvider */
?>
<br>
<a href="<?php echo Yii::app()->config->get('baseUrl');?>/_admin/graduate/create">Додати випускника</a>
<br>
<a href="<?php echo Yii::app()->config->get('baseUrl');?>/_admin/graduate/admin">Управління випускниками</a>

<h1>Випускники</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'graduates',
    'dataProvider' => $dataProvider,
    'htmlOptions' => array('class' => 'grid-view custom', 'id' => 'graduate-form'),
    'summaryText' => '',
    'columns' => array(
        'first_name',
        'last_name',
        array(
            'header' => 'Аватар',
            'value' => 'StaticFilesHelper::createPath("image", "graduates", $data->avatar)',
            'type' => 'image',
        ),
        'position',
        'work_place',
        'courses',
        'history',
        'rate',
        'recall',
    ),

)); ?>
