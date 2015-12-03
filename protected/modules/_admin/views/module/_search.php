<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'module_ID'); ?>
		<?php echo $form->textField($model,'module_ID',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'title_ru'); ?>
		<?php echo $form->textField($model,'title_ru',array('size'=>60,'maxlength'=>255,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'module_number'); ?>
		<?php echo $form->textField($model,'module_number',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'title_en'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>255,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'title_ua'); ?>
		<?php echo $form->textField($model,'title_ua',array('size'=>60,'maxlength'=>255,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>30,'maxlength'=>30,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>6,'maxlength'=>6,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'module_duration_hours'); ?>
		<?php echo $form->textField($model,'module_duration_hours',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'module_duration_days'); ?>
		<?php echo $form->textField($model,'module_duration_days',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'lesson_count'); ?>
		<?php echo $form->textField($model,'lesson_count',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'module_price'); ?>
		<?php echo $form->textField($model,'module_price',array('size'=>10,'maxlength'=>10,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'for_whom'); ?>
		<?php echo $form->textArea($model,'for_whom',array('rows'=>6, 'cols'=>50,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'what_you_learn'); ?>
		<?php echo $form->textArea($model,'what_you_learn',array('rows'=>6, 'cols'=>50,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'what_you_get'); ?>
		<?php echo $form->textArea($model,'what_you_get',array('rows'=>6, 'cols'=>50,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'module_img'); ?>
		<?php echo $form->textField($model,'module_img',array('size'=>60,'maxlength'=>255,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'about_module'); ?>
		<?php echo $form->textArea($model,'about_module',array('rows'=>6, 'cols'=>50,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'owners'); ?>
		<?php echo $form->textField($model,'owners',array('size'=>60,'maxlength'=>100,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'level'); ?>
		<?php echo $form->textField($model,'level',array('size'=>13,'maxlength'=>13,'class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'hours_in_day'); ?>
		<?php echo $form->textField($model,'hours_in_day',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'days_in_week'); ?>
		<?php echo $form->textField($model,'days_in_week',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating',array('class'=> 'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->