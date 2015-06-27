<?php
/* @var $this MessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	//array('label'=>'Create Messages', 'url'=>array('create')),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);
?>

<h1>Messages</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>'ID',
            'value'=>'$data->id',
        ),
        array(
            'header'=>'Language',
            'value'=>'"{$data->language}"',
        ),
        array(
            'header'=>'Category',
            'value'=> 'MessagesHelper::getMessageCategory($data->id)',
        ),
        array(
            'header'=>'Translation',
            'value'=>'$data->translation',
        ),
    ),
)); ?>
