<?php
/* @var $this CoursemanageController */
/* @var $dataProvider CActiveDataProvider */
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create');?>"><?php echo Yii::t("coursemanage", "0511");?></a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/admin');?>"><?php echo Yii::t("coursemanage", "0512");?></a>


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
