<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'carousel-form',
        'htmlOptions' => array(
            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
        ),
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate' => 'js:function(){
                return validateSliderForm("'.$model->scenario.'");
                }',
        )
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

    <div class="form-group">
        <p class="note" style="color: #ff0000">Зверніть увагу зображення рекомендовані пропорції 2.18 до 1</p>
        <?php echo $form->labelEx($model, 'pictureURL', array('for' => 'picture')); ?>
        <?php echo $form->fileField($model, 'pictureURL', array('size' => 50, 'maxlength' => 50, 'id' => 'picture','onchange'=>"CheckFile(this)")); ?>
        <div class="errorMessage" style="display: none"></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'text_ua', array('for' => 'text_ua')); ?>
        <?php echo $form->textArea($model, 'text_ua', array('class' => "form-control", 'id' => 'text_ua','style' => 'resize:none')); ?>
        <?php echo $form->error($model, 'text_ua'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'text_ru', array('for' => 'text_ru')); ?>
        <?php echo $form->textArea($model, 'text_ru', array('class' => "form-control", 'id' => 'text_ru','style' => 'resize:none')); ?>
        <?php echo $form->error($model, 'text_ru'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'text_en', array('for' => 'text_en')); ?>
        <?php echo $form->textArea($model, 'text_en', array('class' => "form-control", 'id' => 'text_en','style' => 'resize:none')); ?>
        <?php echo $form->error($model, 'text_en'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти',array('id'=>'submitButton')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>