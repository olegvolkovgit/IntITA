<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index'); ?>">Список фото</a>

    <h1>Додати фото</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>