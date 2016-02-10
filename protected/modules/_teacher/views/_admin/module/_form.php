<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'module-form',
        'htmlOptions' => array(
            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
            'method' => 'POST',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation'=>true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'afterValidate' => 'js:function(form,data,hasError){
                sendError(form,data,hasError);
                }',
            'validateOnSubmit' => true,
            'validateOnChange' => false),
    )); ?>

    <div class="form-group" style="visibility: hidden; height:0px">
        <?php echo $form->labelEx($model, 'module_ID'); ?>
        <?php echo $form->textField($model, 'module_ID', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'module_number'); ?>
        <?php echo $form->textField($model, 'module_number', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'module_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'alias'); ?>
        <?php echo $form->textField($model, 'alias', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'alias'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'module_price'); ?>
        <?php echo $form->textField($model, 'module_price', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'module_price'); ?>
    </div>


    <div class="form-group">
        <?php echo CHtml::submitButton('Зберегти',array('class' => 'btn btn-submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
