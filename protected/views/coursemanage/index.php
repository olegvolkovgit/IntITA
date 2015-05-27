<?php
/* @var $this CoursemanageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Courses',
);

$this->menu=array(
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>Courses</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'cssFile'=>Yii::app()->baseUrl . '/css/customCGridView.css',
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText'=>'Показано курсів {start} - {end} з {count}',
	'columns'=>array(
        array(
            'name'=>'course_ID',
            'header'=>'ID',
        ),
        array(
            'name'=>'course_name',
            'header'=>'Назва курсу',
        ),
        array(
            'name'=>'level',
            'header'=>'Рівень',
        ),
        array(
            'name'=>'course_duration_hours',
            'header'=>'Тривалість курсу',
        ),
        array(
            'name'=>'course_price',
            'header'=>'Вартість курсу',
        ),
    ),
)); ?>
