<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminSlider.css" />
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index');?>">Список фото</a>

<h1>Зображення #<?php echo $model->image_order; ?></h1>

<img src="<?php echo StaticFilesHelper::createPath("image", "aboutus", $model->pictureUrl);?>" id="pictureLarge" />

<br>
<br>
