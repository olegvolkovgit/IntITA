<?php
/* @var $this ConfigController */
/* @var $data Config */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <button type="button" class="btn btn-link">
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    </button>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('param')); ?>:</b>
	<?php echo CHtml::encode($data->param); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default')); ?>:</b>
	<?php echo CHtml::encode($data->default); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label')); ?>:</b>
	<?php echo CHtml::encode($data->label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />


</div>