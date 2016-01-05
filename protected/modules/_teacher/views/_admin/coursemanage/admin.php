<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
                <?php echo Yii::t("coursemanage", "0510"); ?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/create'); ?>')">
                <?php echo Yii::t("coursemanage", "0511"); ?></button>
        </li>
    </ul>

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
    <link rel="stylesheet" type="text/css" href="<?= Config::getBaseUrl('css', 'formattedForm.css'); ?>"/>
    <div class="page-header">
        <h4>Управління курсами</h4>
    </div>
    <p>
        <?php echo Yii::t("coursemanage", "0513") ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
            &lt;&gt;</b>, <b>=</b>)
    </p>
    <button type="button" class="btn btn-link">
        <?php echo CHtml::link(Yii::t("coursemanage", "0515"), '#', array('class' => 'search-button')); ?>
    </button>
    <div class="search-form" style="display:none">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'course-grid',
    'summaryText' => Yii::t("coursemanage", "0516") . ' {start} - {end} / {count}',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl(). '/css/pager.css'
    ),
    'dataProvider' => $model->search(),
    'emptyText' => Yii::t("coursemanage", "0517"),
//    'filter' => $model,
    'columns' => array(
        'course_ID',
        'alias',
        'course_number',
        'language',
        'title_ua',
        'level',
        'start',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{restore}',
            'deleteConfirmation' => Yii::t("coursemanage", "0518"),
            'headerHtmlOptions' => array('style' => 'width:100px'),
            'buttons' => array(
                'restore' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('course-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label' => 'Відновити курс',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/coursemanage/restore", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
//                    'options' => array(
//                        'class' => 'controlButtons;',
//                    )
                ),
                'view' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('course-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/coursemanage/view", array("id"=>$data->primaryKey))',
                ),
                'update' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('course-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/coursemanage/update", array("id"=>$data->primaryKey))',
                ),

            ),
        ),
    ),
)); ?>