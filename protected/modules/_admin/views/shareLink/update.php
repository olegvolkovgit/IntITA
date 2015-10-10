<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */



$this->menu=array(
	array('label'=>'List ShareLink', 'url'=>array('index')),
	array('label'=>'Create ShareLink', 'url'=>array('create')),
	array('label'=>'View ShareLink', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ShareLink', 'url'=>array('admin')),
);
?>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/sharelink/index');?>">Перегляд посиланнь на ресурси</a>
    <br>
<h1>Редагувати ресурс <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>