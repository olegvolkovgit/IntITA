<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/create');?>">Додати випускника</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index');?>">Список випускників</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/update', array('id' => $model->id));?>">Редагувати інформацію про випускника</a>


<h1>Переглянути інформацію про випускника #<?php echo $model->first_name." ".$model->last_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
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
		'rate',
		'recall',
	),
)); ?>
