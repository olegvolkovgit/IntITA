<?php
/* @var $this ExternalSourcesController */
/* @var $data ExternalSources */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('source_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->source_id), array('view', 'id'=>$data->source_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash')); ?>:</b>
	<?php echo CHtml::encode($data->cash); ?>
	<br />


</div>