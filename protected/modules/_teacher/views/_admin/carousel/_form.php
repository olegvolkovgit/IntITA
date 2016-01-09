<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'carousel-form',
        'htmlOptions' => array(
            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false),
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

    <div class="form-group">
        <p class="note" style="color: #ff0000">Зверніть увагу зображення рекомендовані пропорції 2.18 до 1</p>
        <?php echo $form->labelEx($model, 'pictureURL', array('for' => 'picture')); ?>
        <?php echo $form->fileField($model, 'pictureURL', array('size' => 50, 'maxlength' => 50, 'id' => 'picture')); ?>
        <?php echo $form->error($model, 'pictureURL'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slider_text', array('for' => 'text')); ?>
        <?php echo $form->textField($model, 'slider_text', array('class' => "form-control", 'id' => 'text')); ?>
        <?php echo $form->error($model, 'slider_text'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->