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

</div>