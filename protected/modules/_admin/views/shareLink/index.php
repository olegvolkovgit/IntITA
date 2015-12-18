<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
$this->menu=array(
    array('label'=>'List ShareLink', 'url'=>array('index')),
    array('label'=>'Create ShareLink', 'url'=>'localhost'.Yii::app()->createUrl('_admin/sahrelink/create')),
);
?>
<br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/shareLink/create');?>">Створити посилання на ресурс</a>
</button>
    <br>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#share-link-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
<h1>Управління ресурсами для викладачів</h1>
</div>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
'links'=>$this->breadcrumbs,
));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'share-link-grid',
    'dataProvider'=>$model->search(),
    'summaryText'=>'',
    'filter'=>$model,
    'columns'=>array(
        'name',
        'link',
        array(
            'class'=>'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
        ),
    ),
)); ?>


