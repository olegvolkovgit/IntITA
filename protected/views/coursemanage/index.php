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
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css'
    ),
	'columns'=>array(
        array(
            'name'=>'course_ID',
            'header'=>'ID',
        ),
        array(
            'name'=>'title_ua',
            'header'=>Yii::t("coursemanage", "0519"),
        ),
        array(
            'name'=>'title_ru',
            'header'=>"Назва російською",
        ),
        array(
            'name'=>'title_en',
            'header'=>'Назва англійською',
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
