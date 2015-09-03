<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index');?>">Список фото</a>

<h1>Додати фото</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>