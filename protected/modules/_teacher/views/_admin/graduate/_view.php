<?php
/* @var $this GraduateController */
/* @var $data Graduate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<img src="<?php echo CHtml::encode(StaticFilesHelper::createPath("image", "graduates", $data->avatar)); ?>"/>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('graduate_date')); ?>:</b>
	<?php echo CHtml::encode($data->graduate_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_place')); ?>:</b>
	<?php echo CHtml::encode($data->work_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_site')); ?>:</b>
	<?php echo CHtml::encode($data->work_site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('courses_page')); ?>:</b>
	<?php echo CHtml::encode($data->courses_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('history')); ?>:</b>
	<?php echo CHtml::encode($data->history); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recall')); ?>:</b>
	<?php echo CHtml::encode($data->recall); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('first_name_en')); ?>:</b>
    <?php echo CHtml::encode($data->first_name_en); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('last_name_en')); ?>:</b>
    <?php echo CHtml::encode($data->last_name_en); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name_ru')); ?>:</b>
	<?php echo CHtml::encode($data->first_name_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name_ru')); ?>:</b>
	<?php echo CHtml::encode($data->last_name_ru); ?>
	<br />

</div>