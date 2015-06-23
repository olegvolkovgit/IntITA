<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'role-attribute-form',
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

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->dropDownList($model,'role', TeacherHelper::getRoleTitlesList()); ?>
        <?php echo $form->error($model,'role'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->textField($model,'type',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name_ru'); ?>
        <?php echo $form->textField($model,'name_ru',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'name_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name_ua'); ?>
        <?php echo $form->textField($model,'name_ua',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'name_ua'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->