<?php
/* @var $this TmanageController */
/* @var $model Roles */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=StaticFilesHelper::fullPathTo('css', 'formattedForm.css')?>"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'roles-form',
        'htmlOptions'=>array(
            'class'=>'formatted-form',
            'enctype'=>'multipart/form-data',
            'method'=>'POST',

        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation'=>true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
    )); ?>

     <div class="form-group">
        <?php echo $form->labelEx($model,'title_en'); ?>
        <?php echo $form->textField($model,'title_en',array('size'=>20,'maxlength'=>20,'class'=> 'form-control')); ?>
        <?php echo $form->error($model,'title_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'title_ru'); ?>
        <?php echo $form->textField($model,'title_ru',array('size'=>20,'maxlength'=>20,'class'=> 'form-control')); ?>
        <?php echo $form->error($model,'title_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'title_ua'); ?>
        <?php echo $form->textField($model,'title_ua',array('size'=>20,'maxlength'=>20,'class'=> 'form-control')); ?>
        <?php echo $form->error($model,'title_ua'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255,'class'=> 'form-control')); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->