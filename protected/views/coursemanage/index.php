<?php
/* @var $this CoursemanageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Курси',
);

$this->menu=array(
	array('label'=>'Створити курс', 'url'=>array('create')),
	array('label'=>'Управління курсами', 'url'=>array('admin')),
);
?>

<h1>Курси</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'summaryText'=>'Показано курсів {start} - {end} з {count}',
    'pager' => array(
        'firstPageLabel'=>'<<',
        'lastPageLabel'=>'>>',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'header'=>'',
    ),
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
