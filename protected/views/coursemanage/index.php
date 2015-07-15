<?php
/* @var $this CoursemanageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t("coursemanage", "0508"),
);

$this->menu=array(
	array('label'=>Yii::t("coursemanage", "0511"), 'url'=>array('create')),
	array('label'=>Yii::t("coursemanage", "0512"), 'url'=>array('admin')),
);
?>
<h1><?php Yii::t("coursemanage", "0508") ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'summaryText'=>Yii::t("coursemanage", "0516").' {start} - {end} / {count}',
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
            'header'=>Yii::t("coursemanage", "0519"),
        ),
        array(
            'name'=>'level',
            'header'=>Yii::t("coursemanage", "0520"),
        ),
        array(
            'name'=>'course_duration_hours',
            'header'=>Yii::t("coursemanage", "0521"),
        ),
        array(
            'name'=>'course_price',
            'header'=>Yii::t("coursemanage", "0522"),
        ),
    ),
)); ?>
