<?php
/* @var $this ResponseController */
/* @var $data Response */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('who')); ?>:</b>
	<?php echo CHtml::encode($data->who); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('who_ip')); ?>:</b>
	<?php echo CHtml::encode($data->who_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('knowledge')); ?>:</b>
	<?php echo CHtml::encode($data->knowledge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('behavior')); ?>:</b>
	<?php echo CHtml::encode($data->behavior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivation')); ?>:</b>
	<?php echo CHtml::encode($data->motivation); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('is_checked')); ?>:</b>
    <?php echo CHtml::encode($data->motivation); ?>
    <br />
</div>