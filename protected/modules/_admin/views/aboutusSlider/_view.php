<?php
/* @var $this AboutusSliderController */
/* @var $data AboutusSlider */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_order')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->image_order), array('view', 'id'=>$data->image_order)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pictureUrl')); ?>:</b>
	<?php echo CHtml::encode($data->pictureUrl); ?>
	<br />


</div>