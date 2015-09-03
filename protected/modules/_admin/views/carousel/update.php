<?php
/* @var $this CarouselController */
/* @var $model Carousel */

//$this->menu=array(
//	array('label'=>'List Carousel', 'url'=>array('index')),
//	array('label'=>'Create Carousel', 'url'=>array('create')),
//	array('label'=>'View Carousel', 'url'=>array('view', 'id'=>$model->order)),
//	array('label'=>'Manage Carousel', 'url'=>array('admin')),
//);
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index');?>">Список фото</a>

<h1>Змінити зображення <?php echo $model->order; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>