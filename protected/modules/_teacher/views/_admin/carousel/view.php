<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminSlider.css'); ?>" />
<br>
<br>
<ul class="list-inline">
    <li>
        <a ng-href="#/admin/carousel" type="button" class="btn btn-primary">Список фото</a>
    </li>
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/carousel/update/id/<?php echo $model->id ?>">Редагувати</a>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                ng-click="deleteSlide('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/delete', array('id' => $model->id));?>')">
            Видалити</button>
    </li>
</ul>

<div class="page-header">
    <h4>Зображення #<?php echo $model->order; ?></h4>
</div>
<img src="<?php echo StaticFilesHelper::createPath("image", "mainpage", $model->pictureURL);?>" id="pictureLarge" />

<br>
<br>
