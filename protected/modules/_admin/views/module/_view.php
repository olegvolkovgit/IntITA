<?php
/* @var $this ModuleController */
/* @var $data Module */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->module_ID), array('view', 'id'=>$data->module_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ru')); ?>:</b>
	<?php echo CHtml::encode($data->title_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_number')); ?>:</b>
	<?php echo CHtml::encode($data->module_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_en')); ?>:</b>
	<?php echo CHtml::encode($data->title_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ua')); ?>:</b>
	<?php echo CHtml::encode($data->title_ua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('module_duration_hours')); ?>:</b>
	<?php echo CHtml::encode($data->module_duration_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_duration_days')); ?>:</b>
	<?php echo CHtml::encode($data->module_duration_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lesson_count')); ?>:</b>
	<?php echo CHtml::encode($data->lesson_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_price')); ?>:</b>
	<?php echo CHtml::encode($data->module_price); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_img')); ?>:</b>
	<?php echo CHtml::encode($data->module_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('about_module')); ?>:</b>
	<?php echo CHtml::encode($data->about_module); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owners')); ?>:</b>
	<?php echo CHtml::encode($data->owners); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hours_in_day')); ?>:</b>
	<?php echo CHtml::encode($data->hours_in_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('days_in_week')); ?>:</b>
	<?php echo CHtml::encode($data->days_in_week); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	*/ ?>

</div>