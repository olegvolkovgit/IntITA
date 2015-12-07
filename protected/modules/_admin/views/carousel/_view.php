<?php
/* @var $this CarouselController */
/* @var $data Carousel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
    <button type="button" class="btn btn-link">
    <?php echo CHtml::link(CHtml::encode($data->order), array('view', 'id'=>$data->order)); ?>
    </button>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pictureURL')); ?>:</b>
	<?php echo CHtml::encode($data->pictureURL); ?>
	<br />


</div>