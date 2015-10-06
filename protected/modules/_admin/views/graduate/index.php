<?php
/* @var $this GraduateController */
/* @var $dataProvider CActiveDataProvider */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminGraduate.css" />
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/create');?>">Додати випускника</a>

<h2>Випускники</h2>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#graduate-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'graduate-grid',
    'dataProvider' => $model->search(),
    'htmlOptions' => array('class' => 'grid-view custom'),
    'summaryText' => '',
    'filter'=>$model,
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
        array(
            'header' => 'Відгук',
            'value' => '$data->recall',
            'htmlOptions' => array('class' => 'recall'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),

)); ?>
