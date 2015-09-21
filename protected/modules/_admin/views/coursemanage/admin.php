<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index');?>"><?php echo Yii::t("coursemanage", "0510");?></a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create');?>"><?php echo Yii::t("coursemanage", "0511");?></a>

<?php
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
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
    <h1>Управління курсами</h1>

    <p>
        <?php echo Yii::t("coursemanage", "0513") ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>)
    </p>

<?php echo CHtml::link(Yii::t("coursemanage", "0515"),'#',array('class'=>'search-button')); ?>
    <div class="search-form" style="display:none">
        <?php $this->renderPartial('_search',array(
            'model'=>$model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'course-grid',
    'summaryText'=>Yii::t("coursemanage", "0516").' {start} - {end} / {count}',
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css'
    ),
    'dataProvider'=>$model->search(),
    'emptyText'=>Yii::t("coursemanage", "0517"),
    'filter'=>$model,
    'columns'=>array(
        'course_ID',
        'alias',
        'course_number',
        'language',
        'title_ua',
        'level',
        'start',
        array(
            'class'=>'CButtonColumn',
            'deleteConfirmation'=>'Yii::t("coursemanage", "0518")',
        ),
    ),
)); ?>