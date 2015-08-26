<?php
/* @var $this GraduateController */
/* @var $model Graduate */

$this->menu=array(
	array('label'=>'List Graduate', 'url'=>array('index')),
	array('label'=>'Create Graduate', 'url'=>array('create')),
	array('label'=>'Update Graduate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Graduate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Graduate', 'url'=>array('admin')),
);
?>

<h1>View Graduate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
        array(
            'header' => 'Аватар',
            'value' => '$data->avatar',
            'type' => 'image',
        ),
		'graduate_date',
		'position',
		'work_place',
		'work_site',
		'courses',
		'courses_page',
		'history',
		'rate',
		'recall',
	),
)); ?>
