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

    <b><?php echo CHtml::encode($data->getAttributeLabel('course_number')); ?>:</b>
    <?php echo CHtml::encode($data->course_number); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ua')); ?>:</b>
	<?php echo CHtml::encode(Course::getCourseName($data->course_ID)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title_ru')); ?>:</b>
    <?php echo CHtml::encode(Course::getCourseName($data->course_ID)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title_en')); ?>:</b>
    <?php echo CHtml::encode(Course::getCourseName($data->course_ID)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_duration_hours')); ?>:</b>
	<?php echo CHtml::encode($data->course_duration_hours); ?>
	<br />

</div>