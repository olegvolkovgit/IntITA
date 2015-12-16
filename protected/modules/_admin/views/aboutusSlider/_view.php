<?php
/* @var $this AboutusSliderController */
/* @var $data AboutusSlider */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('image_order')); ?>:</b>
    <button type="button" class="btn btn-link">
        <?php echo CHtml::link(CHtml::encode($data->image_order), array('view', 'id' => $data->image_order)); ?>
    </button>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('pictureUrl')); ?>:</b>
    <?php echo CHtml::encode($data->pictureUrl); ?>
    <br/>


</div>