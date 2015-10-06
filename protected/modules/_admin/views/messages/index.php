<?php
/* @var $this MessagesController */
/* @var $model Messages */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#messages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/messages/create');?>">Додати повідомлення</a>

<h1>Інтерфейс сайта</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'messages-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=> Config::getBaseUrl().'/css/pager.css'
    ),
    'summaryText'=>'',
    'columns'=>array(
        'id',
        'language',
        array(
            'header' => 'Категорія',
            'value' => 'MessagesHelper::getMessageCategory($data->id)',
        ),
        'translation',
        array(
            'header' => 'Коментар',
            'value' => 'MessagesHelper::getMessageCommentById($data->id)',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),
    ),
)); ?>
