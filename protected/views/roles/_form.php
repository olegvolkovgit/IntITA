<?php
/* @var $this RolesController */
/* @var $model Roles */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title_en'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'title_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title_ru'); ?>
		<?php echo $form->textField($model,'title_ru',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'title_ru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title_ua'); ?>
		<?php echo $form->textField($model,'title_ua',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'title_ua'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->