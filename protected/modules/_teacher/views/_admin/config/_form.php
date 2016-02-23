<?php
/* @var $this ConfigController */
/* @var $model Config */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
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
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'param', array('for' => 'param')); ?>
        <?php echo $form->textField($model, 'param', array('size' => 60, 'maxlength' => 128, 'class' => "form-control",
            'id' => 'param')); ?>
        <?php echo $form->error($model, 'param'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'value', array('for' => 'value')); ?>
        <?php echo $form->textArea($model, 'value', array('rows' => 6, 'cols' => 50, 'class' => "form-control",
            'id' => 'value')); ?>
        <?php echo $form->error($model, 'value'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'default', array('for' => 'default')); ?>
        <?php echo $form->textArea($model, 'default', array('rows' => 6, 'cols' => 50, 'class' => "form-control",
            'id' => 'default')); ?>
        <?php echo $form->error($model, 'default'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'label', array('for' => 'label')); ?>
        <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 255, 'class' => "form-control",
            'id' => 'label1')); ?>
        <?php echo $form->error($model, 'label'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'type', array('for' => 'type')); ?>
        <?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 128, 'class' => "form-control",
            'id' => 'type')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton('Зберегти',array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->