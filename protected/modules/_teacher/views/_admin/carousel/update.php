<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index'); ?>">Список фото</a>

    <h1>Змінити зображення <?php echo $model->order; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>