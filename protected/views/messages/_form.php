<div class="form">


<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'messages-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->dropDownList($model, 'id');//CHtml::listData(Sourcemessages::model()->findAllByAttributes())); ?>
		<?php echo $form->error($model,'id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model, 'language', array('maxlength' => 16)); ?>
		<?php echo $form->error($model,'language'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textArea($model, 'translation'); ?>
		<?php echo $form->error($model,'translation'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->