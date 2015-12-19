<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index'); ?>">Список фото</a>
    </button>

    <div class="page-header">
        <h2>Змінити зображення #<?php echo $model->image_order; ?></h2>
    </div>

<?php $this->renderPartial('_form', array('model' => $model)); ?>