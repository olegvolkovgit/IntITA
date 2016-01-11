<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<br>
<br>

        <a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index');?>">Список фото</a>

    <div class="page-header">
        <h1>Зображення #<?php echo $model->order; ?></h1>
    </div>
<img src="<?php echo StaticFilesHelper::createPath("image", "mainpage", $model->pictureURL);?>" id="pictureLarge" />

<br>
<br>
