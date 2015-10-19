<?php
/* @var $this ResponseController */
/* @var $model Response */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'response-form',
    'htmlOptions'=>array(
        'class'=>'formatted-form',
        'enctype'=>'multipart/form-data',
        'method'=>'POST',
    ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'who'); ?>
		<?php echo $form->textField($model,'who'); ?>
		<?php echo $form->error($model,'who'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate'); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'who_ip'); ?>
		<?php echo $form->textField($model,'who_ip',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'who_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'knowledge'); ?>
		<?php echo $form->textField($model,'knowledge'); ?>
		<?php echo $form->error($model,'knowledge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'behavior'); ?>
		<?php echo $form->textField($model,'behavior'); ?>
		<?php echo $form->error($model,'behavior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivation'); ?>
		<?php echo $form->textField($model,'motivation'); ?>
		<?php echo $form->error($model,'motivation'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'is_checked'); ?>
        <?php echo $form->dropDownList($model, 'is_checked',array('1' => 'перевірено модератором', '0' => 'не перевірено модератором')); ?>
        <?php echo $form->error($model,'is_checked'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->