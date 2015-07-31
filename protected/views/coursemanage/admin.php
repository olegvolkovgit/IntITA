<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
    Yii::t("coursemanage", "0508")=>array('index'),
    Yii::t("coursemanage", "0509"),
);

$this->menu=array(
	array('label'=>Yii::t("coursemanage", "0510"), 'url'=>array('index')),
	array('label'=>Yii::t("coursemanage", "0511"), 'url'=>array('create')),
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
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
<h1><?php echo Yii::t("coursemanage", "0511") ?></h1>

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
        'firstPageLabel'=>'<<',
        'lastPageLabel'=>'>>',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'header'=>'',
    ),
	'dataProvider'=>$model->search(),
    'emptyText'=>Yii::t("coursemanage", "0517"),
	'filter'=>$model,
	'columns'=>array(
		'course_ID',
		'alias',
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
