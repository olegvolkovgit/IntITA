<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>"/>
<br>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index'); ?>">Список фото</a>
</button>

<div class="page-header">
    <h2>Зображення #<?php echo $model->image_order; ?></small></h2>
</div>
<div class="page-header">
    <img src="<?php echo StaticFilesHelper::createPath("image", "aboutus", $model->pictureUrl); ?>" id="pictureLarge"/>
</div>
<br>
<br>
