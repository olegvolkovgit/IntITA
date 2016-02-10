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
    'enableClientValidation'=>true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'afterValidate' => 'js:function(form,data,hasError){
                sendError(form,data,hasError);
                }',
        'validateOnSubmit' => true,
        'validateOnChange' => false),
)); ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'who'); ?>
		<?php echo $form->textField($model,'who',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'who'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'who_ip'); ?>
		<?php echo $form->textField($model,'who_ip',array('size'=>40,'maxlength'=>40,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'who_ip'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'knowledge'); ?>
		<?php echo $form->textField($model,'knowledge',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'knowledge'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'behavior'); ?>
		<?php echo $form->textField($model,'behavior',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'behavior'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'motivation'); ?>
		<?php echo $form->textField($model,'motivation',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'motivation'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'is_checked'); ?>
        <?php echo $form->dropDownList($model, 'is_checked',
            array('1' => 'перевірено модератором', '0' => 'не перевірено модератором'),array('class'=>"form-control")); ?>
        <?php echo $form->error($model,'is_checked'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->