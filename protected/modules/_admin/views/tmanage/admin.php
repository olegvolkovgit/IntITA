<?php
/* @var $model Teacher */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#teacher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>

    <div class="page-header">
    <h1>Управління викладачами</h1>
    </div>
    <p>
        Ви також можете використовувати вирази (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        або <b>=</b>)
    </p>
    <button type="button" class="btn btn-link">
<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
    </button>
    <div class="search-form" style="display:none">
        <?php $this->renderPartial('_search',array(
            'model'=>$model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'teacher-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText' => 'Показано викладачів {start} - {end} з {count}',
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css'
    ),
    'columns'=>array(
        'first_name',
        'middle_name',
        'last_name',
        'foto_url',
        'isPrint',
        array(
            'class'=>'CButtonColumn',
            'deleteConfirmation'=>"js:'Ви підтверджуєте видалення викладача '+$(this).parent().parent().children(':first-child').text()+'?'",
            'headerHtmlOptions' => array('style' => 'width:80px'),
        ),
    ),
)); ?>