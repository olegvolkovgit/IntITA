<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<br>
<br>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/index');?>')">
            Список фото</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/update', array('id' => $model->id));?>')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="deleteMainSlide('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/delete', array('id' => $model->id));?>')">
            Видалити</button>
    </li>
</ul>

    <div class="page-header">
        <h4>Зображення #<?php echo $model->order; ?></h4>
    </div>
<img src="<?php echo StaticFilesHelper::createPath("image", "mainpage", $model->pictureURL);?>" id="pictureLarge" />

<br>
<br>
