<?php
/* @var $this ChatPhrasesController */
/* @var $model ChatPhrases */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-phrases-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_en'); ?>
		<?php echo $form->textField($model,'text_en',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'text_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_ru'); ?>
		<?php echo $form->textField($model,'text_ru',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'text_ru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_ua'); ?>
		<?php echo $form->textField($model,'text_ua',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'text_ua'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->