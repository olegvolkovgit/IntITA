<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carousel-form',
    'htmlOptions'=>array(
        'class'=>'formatted-form',
        'enctype'=>'multipart/form-data',
    ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

<!--	--><?php //echo $form->errorSummary($model); ?>
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'order'); ?>
<!--		--><?php //echo $form->textField($model,'order'); ?>
<!--		--><?php //echo $form->error($model,'order'); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'pictureURL'); ?>
		<?php echo $form->fileField($model,'pictureURL',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pictureURL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slider_text'); ?>
		<?php echo $form->textField($model,'slider_text'); ?>
		<?php echo $form->error($model,'slider_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->