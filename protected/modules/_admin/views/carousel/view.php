<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminSlider.css" />
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/carousel/index');?>">Список фото</a>

<h1>Зображення #<?php echo $model->order; ?></h1>
<img src="<?php echo StaticFilesHelper::createPath("image", "mainpage", $model->pictureURL);?>" id="pictureLarge" />

<br>
<br>
