<?php
/* @var $model Roles */
/* @var $form CActiveForm */
/* $this RolesController */
?>

<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'role-form',
        'action'=>Yii::app()->createUrl('roles/create'),
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

    <p class="note">Поля з <span class="required">*</span> обов&#8217;язкові.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title_en'); ?>
        <?php echo $form->textField($model,'title_en',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'title_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ua'); ?>
        <?php echo $form->textField($model,'title_ua',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'title_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ru'); ?>
        <?php echo $form->textField($model,'title_ru',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'title_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->