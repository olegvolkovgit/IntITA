<?php
/* @var $model Teacher */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Управління',
);
$this->menu=array(
    array('label'=>'Список викладачів', 'url'=>array('index')),
    array('label'=>'Додати викладача', 'url'=>array('create')),
);
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
    <h1>Управління викладачами</h1>

    <p>
        Ви також можете використовувати вирази (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        або <b>=</b>)
    </p>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
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
    'columns'=>array(
        'first_name',
        'middle_name',
        'last_name',
        'foto_url',
        /*
        'subjects',
        'profile_text_first',
        'profile_text_short',
        'profile_text_last',
        'readMoreLink',
        'email',
        'tel',
        'skype',
        'smallImage',
        'rate_knowledge',
        'rate_efficiency',
        'rate_relations',
        'sections',
        'user_id',
        */
        array(
            'class'=>'CButtonColumn',
            'deleteConfirmation'=>'Ви впевнені?',
        ),
    ),
)); ?>