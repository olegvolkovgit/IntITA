<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index'); ?>">Список фото</a>
    </button>
    <div class="page-header">
        <h1>Додати фото</h1>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>