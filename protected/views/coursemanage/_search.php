<?php
/* @var $this CoursemanageController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'id'=>'extseach-form'
)); ?>

	<div class="row">
		<?php echo $form->label($model,'course_ID'); ?>
		<?php echo $form->textField($model,'course_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'course_name'); ?>
		<?php echo $form->textField($model,'course_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'level'); ?>
		<?php echo $form->textField($model,'level',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modules_count'); ?>
		<?php echo $form->textField($model,'modules_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'course_duration_hours'); ?>
		<?php echo $form->textField($model,'course_duration_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'course_price'); ?>
		<?php echo $form->textField($model,'course_price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->