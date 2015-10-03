<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */

//$this->breadcrumbs=array(
//    'Share Links'=>array('index'),
//    'Manage',
//);

$this->menu=array(
    array('label'=>'List ShareLink', 'url'=>array('index')),
    array('label'=>'Create ShareLink', 'url'=>array('create')),
);

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

<h1>Управління ресурсами для викладачів</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<!--    --><?php //$this->renderPartial('_search',array(
//        'model'=>$model,
//    )); ?>
<!--</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'share-link-grid',
    'dataProvider'=>$model->search(),
    'summaryText'=>'',
    'filter'=>$model,
    'columns'=>array(
        //'id',
        'name',
        'link',
        array(
            'class'=>'CButtonColumn',

        ),
    ),
)); ?>


<?php
///* @var $this ShareLinkController */
///* @var $dataProvider CActiveDataProvider */
//
//$this->breadcrumbs=array(
//	'Share Links',
//);
//
//$this->menu=array(
//	array('label'=>'Create ShareLink', 'url'=>array('create')),
//	array('label'=>'Manage ShareLink', 'url'=>array('admin')),
//);
//?>
<!---->
<!--<h1>Share Links</h1>-->
<!---->
<?php //$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//    'summaryText'=>''
//)); ?>
