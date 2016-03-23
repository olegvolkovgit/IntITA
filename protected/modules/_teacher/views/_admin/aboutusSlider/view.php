<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>"/>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index');?>')">
            Список фото</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/update', array('id' => $model->image_order));?>')">
            Редагувати</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="deleteSlideAboutUs('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/delete', array('id' => $model->image_order));?>')">
            Видалити</button>
    </li>
</ul>

<div class="page-header">
    <h4>Зображення #<?php echo $model->image_order; ?></small></h4>
</div>

<div class="page-header">
    <img src="<?php echo StaticFilesHelper::createPath("image", "aboutus", $model->pictureUrl); ?>" id="pictureLarge"/>
</div>
<br>
<br>
