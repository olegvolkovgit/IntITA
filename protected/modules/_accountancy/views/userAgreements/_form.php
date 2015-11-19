<?php
/* @var $this UserAgreementsController */
/* @var $model UserAgreements */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-agreements-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_id'); ?>
		<?php echo $form->textField($model,'service_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_user'); ?>
		<?php echo $form->textField($model,'approval_user'); ?>
		<?php echo $form->error($model,'approval_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date'); ?>
		<?php echo $form->error($model,'approval_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancel_user'); ?>
		<?php echo $form->textField($model,'cancel_user'); ?>
		<?php echo $form->error($model,'cancel_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancel_date'); ?>
		<?php echo $form->textField($model,'cancel_date'); ?>
		<?php echo $form->error($model,'cancel_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'close_date'); ?>
		<?php echo $form->textField($model,'close_date'); ?>
		<?php echo $form->error($model,'close_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_schema'); ?>
		<?php echo $form->textField($model,'payment_schema',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'payment_schema'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->