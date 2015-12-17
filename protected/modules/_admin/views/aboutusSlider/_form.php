<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', '_admin/aboutus.css') ?>"/>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'aboutus-slider-form',
        'htmlOptions' => array(
            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

    <div class="form-group">
        <p class="note" style="color: #ff0000">Зверніть увагу зображення рекомендовані пропорції 3 до 1 </p>
        <?php echo $form->labelEx($model, 'pictureUrl'); ?>
        <?php echo $form->fileField($model, 'pictureUrl'); ?>
        <?php echo $form->error($model, 'pictureUrl'); ?>
    </div>
    <br>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'text', array('for' => 'text')); ?>
        <?php echo $form->textField($model, 'text', array('class' => "form-control", 'id' => 'text')); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->