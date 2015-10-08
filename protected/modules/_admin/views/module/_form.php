<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'module-form',
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

    <div class="row" style="visibility: hidden; height:0px">
        <?php echo $form->labelEx($model,'module_ID'); ?>
        <?php echo $form->textField($model,'module_ID',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'module_number'); ?>
        <?php echo $form->textField($model,'module_number',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'module_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'alias'); ?>
        <?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'alias'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'module_price'); ?>
        <?php echo $form->textField($model,'module_price'); ?>
        <?php echo $form->error($model,'module_price'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
