<?php
/* @var $this CoursemanageController */
/* @var $model Course */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
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

	<p class="note">Поля з <span class="required">*</span> обов&#8217;язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->dropDownList($model,'language',array(
                'ua'=>'Українська','en'=>'English','ru'=>'Русский'),
            array('options'=>array('ua'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_name'); ?>
		<?php echo $form->textField($model,'course_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'course_name'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'level'); ?>
        <?php echo $form->dropDownList($model, 'level', array('intern'=> 'Стажер', 'junior' => 'Початківець','strong junior' => 'Сильний початківець', 'middle' => 'Середній', 'senior' => 'Високий'),array('options'=>array('intern'=>array('selected'=>true))));?>
        <?php echo $form->error($model,'level'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start',array('placeholder'=>'РРРР-ММ-ДД')); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array(
                '0'=>'В розробці','1'=>'Готовий'),
            array('options'=>array('0'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_price'); ?>
		<?php echo $form->textField($model,'course_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'course_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_whom'); ?>
		<?php echo $form->textArea($model,'for_whom',array('placeholder'=>"Для коректного відображення розділяйте пункти знаком ';'", 'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'for_whom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'what_you_learn'); ?>
		<?php echo $form->textArea($model,'what_you_learn',array('placeholder'=>"Для коректного відображення розділяйте пункти знаком ';'",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'what_you_learn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'what_you_get'); ?>
		<?php echo $form->textArea($model,'what_you_get',array('placeholder'=>"Для коректного відображення розділяйте пункти знаком ';'",'rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'what_you_get'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_img'); ?>
        <?php echo $form->fileField($model,'course_img'); ?>
		<?php echo $form->error($model,'course_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'review'); ?>
		<?php echo $form->textArea($model,'review',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'review'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->