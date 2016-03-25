<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
/* @var $form CActiveForm */
?>
<div class="formMargin">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'share-link-form',
            'htmlOptions' => array(
                'class' => 'formatted-form',
                'enctype' => 'multipart/form-data',
                'method' => 'POST',
            ),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'clientOptions' => array(
                'afterValidate' => 'js:function(form,data,hasError){
                sendError(form,data,hasError);return true;
                }',
                'validateOnSubmit' => true,
                'validateOnChange' => false),
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'link'); ?>
            <?php echo $form->textArea($model, 'link', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'link'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти',
                array(
                    'class' => 'btn btn-primary',
                    'id' => 'submitButton'
                )); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>