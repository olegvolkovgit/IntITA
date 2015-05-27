<?php
/* @var $this MytestController */
/* @var $data Teacher */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->teacher_id), array('view', 'id'=>$data->teacher_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang')); ?>:</b>
	<?php echo CHtml::encode($data->lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->middle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto_url')); ?>:</b>
	<?php echo CHtml::encode($data->foto_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subjects')); ?>:</b>
	<?php echo CHtml::encode($data->subjects); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_text_first')); ?>:</b>
	<?php echo CHtml::encode($data->profile_text_first); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_text_short')); ?>:</b>
	<?php echo CHtml::encode($data->profile_text_short); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_text_last')); ?>:</b>
	<?php echo CHtml::encode($data->profile_text_last); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('readMoreLink')); ?>:</b>
	<?php echo CHtml::encode($data->readMoreLink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel')); ?>:</b>
	<?php echo CHtml::encode($data->tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skype')); ?>:</b>
	<?php echo CHtml::encode($data->skype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('linkName')); ?>:</b>
	<?php echo CHtml::encode($data->linkName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('smallImage')); ?>:</b>
	<?php echo CHtml::encode($data->smallImage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_knowledge')); ?>:</b>
	<?php echo CHtml::encode($data->rate_knowledge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_efficiency')); ?>:</b>
	<?php echo CHtml::encode($data->rate_efficiency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate_relations')); ?>:</b>
	<?php echo CHtml::encode($data->rate_relations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sections')); ?>:</b>
	<?php echo CHtml::encode($data->sections); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('courses')); ?>:</b>
	<?php echo CHtml::encode($data->courses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto_url_short')); ?>:</b>
	<?php echo CHtml::encode($data->foto_url_short); ?>
	<br />

	*/ ?>

</div>