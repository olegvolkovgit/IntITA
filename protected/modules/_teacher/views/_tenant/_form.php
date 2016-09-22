<?php
/* @var $this ChatPhrasesController */
/* @var $model ChatPhrases */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-phrases-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,

)); ?>


	<div class="row">
		<label>Фраза</label>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>255, 'class' => 'form-control' )); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
	<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class'=>'btn btn-primary')); ?>
		<button type="reset" class="btn btn-default"
				onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>')">
			Скасувати
		</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->