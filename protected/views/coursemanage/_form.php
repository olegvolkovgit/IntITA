<?php
/* @var $this CoursemanageController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_name'); ?>
		<?php echo $form->textField($model,'course_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'course_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model,'level',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modules_count'); ?>
		<?php echo $form->textField($model,'modules_count'); ?>
		<?php echo $form->error($model,'modules_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_duration_hours'); ?>
		<?php echo $form->textField($model,'course_duration_hours'); ?>
		<?php echo $form->error($model,'course_duration_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_price'); ?>
		<?php echo $form->textField($model,'course_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'course_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_whom'); ?>
		<?php echo $form->textArea($model,'for_whom',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'for_whom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'what_you_learn'); ?>
		<?php echo $form->textArea($model,'what_you_learn',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'what_you_learn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'what_you_get'); ?>
		<?php echo $form->textArea($model,'what_you_get',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'what_you_get'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_img'); ?>
		<?php echo $form->textField($model,'course_img',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'course_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'review'); ?>
		<?php echo $form->textArea($model,'review',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'review'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->