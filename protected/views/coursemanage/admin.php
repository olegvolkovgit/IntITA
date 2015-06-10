<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Курси'=>array('index'),
	'Управління',
);

$this->menu=array(
	array('label'=>'Список курсів', 'url'=>array('index')),
	array('label'=>'Створити курс', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#course-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління курсами</h1>

<p>
Ви можете використовувати вирази (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
або <b>=</b>)
</p>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-grid',
    'summaryText'=>'Показано курсів {start} - {end} з {count}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'course_ID',
		'alias',
		'language',
		'course_name',
		'level',
		'start',
		/*
		'status',
		'modules_count',
		'course_duration_hours',
		'course_price',
		'for_whom',
		'what_you_learn',
		'what_you_get',
		'course_img',
		'review',
		*/
		array(
			'class'=>'CButtonColumn',
            'deleteConfirmation'=>'Ви впевнені?',
		),
	),
)); ?>
