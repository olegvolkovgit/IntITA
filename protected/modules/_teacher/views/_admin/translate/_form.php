<?php
/* @var $this MessagesController */
/* @var $model Translate */
/* @var $form CActiveForm */
?>
<div class="formMargin">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'translate-grid',
            'htmlOptions' => array(
                'class' => 'formatted-form',
                'enctype' => 'multipart/form-data',
            ),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'afterValidate' => 'js:function(form,data,hasError){
                sendError(form,data,hasError);return true;
                }',
                'validateOnSubmit' => true,
                'validateOnChange' => false),
        )); ?>

        <div class="form-group">
            <?php echo $form->hiddenField($model, 'id', array('class' => "form-control")); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'language'); ?>
            <?php echo $form->textField($model, 'language', array('size' => 16, 'maxlength' => 16, 'class' => "form-control translateLanguage")); ?>
            <?php echo $form->error($model, 'language'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'translation'); ?>
            <?php echo $form->textArea($model, 'translation', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'translation'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'comment'); ?>
            <?php echo $form->textArea($model, 'comment', array(
                'value' => MessageComment::getMessageCommentById($model->id),
                'rows' => 6,
                'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'comment'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Зберегти', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>