<?php
/* @var $this CoursemanageController */
/* @var $data Course */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->course_ID), array('view', 'id'=>$data->course_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_name')); ?>:</b>
	<?php echo CHtml::encode($data->course_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start')); ?>:</b>
	<?php echo CHtml::encode($data->start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modules_count')); ?>:</b>
	<?php echo CHtml::encode($data->modules_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_duration_hours')); ?>:</b>
	<?php echo CHtml::encode($data->course_duration_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_price')); ?>:</b>
	<?php echo CHtml::encode($data->course_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_whom')); ?>:</b>
	<?php echo CHtml::encode($data->for_whom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('what_you_learn')); ?>:</b>
	<?php echo CHtml::encode($data->what_you_learn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('what_you_get')); ?>:</b>
	<?php echo CHtml::encode($data->what_you_get); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_img')); ?>:</b>
	<?php echo CHtml::encode($data->course_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review')); ?>:</b>
	<?php echo CHtml::encode($data->review); ?>
	<br />

	*/ ?>

</div>