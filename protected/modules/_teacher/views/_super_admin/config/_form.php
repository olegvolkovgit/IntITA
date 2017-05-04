<?php
/* @var $this ConfigController */
/* @var $model Config */
/* @var $form CActiveForm */
?>
<div class="formMargin">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'config-form',
            'htmlOptions' => array(
                'class' => 'formatted-form',
                'enctype' => 'multipart/form-data',
                'method' => 'POST',
            ),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            )
        )); ?>

        <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'param'); ?>
            <?php echo $form->textField($model, 'param', array('size' => 60, 'maxlength' => 128, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'param'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'value'); ?>
            <?php echo $form->textArea($model, 'value', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'value'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'default'); ?>
            <?php echo $form->textArea($model, 'default', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'default'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'label'); ?>
            <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'label'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'type'); ?>
            <?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 128, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Зберегти', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>