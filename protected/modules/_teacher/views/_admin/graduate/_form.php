<?php
/* @var $this GraduateController */
/* @var $model Graduate */
/* @var $form CActiveForm */
?>
<div class="formMargin">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'graduate-form',
            'htmlOptions' => array(
                'class' => 'formatted-form',
                'enctype' => 'multipart/form-data',
                'method' => 'POST',
            ),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'afterValidate' => 'js:function(form,data,hasError){
                sendError(form,data,hasError);return true;
                }',
            )
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'first_name'); ?>
            <?php echo $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'first_name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'last_name'); ?>
            <?php echo $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'last_name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'avatar'); ?>
            <?php echo CHtml::activeFileField($model, 'avatar', array('onchange' => "CheckFile(this)")); ?>
            <div class="errorMessage" style="display: none"></div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'graduate_date'); ?>
            <?php echo $form->dateField($model, 'graduate_date', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'graduate_date'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'position'); ?>
            <?php echo $form->textField($model, 'position', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'position'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'work_place'); ?>
            <?php echo $form->textField($model, 'work_place', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'work_place'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'work_site'); ?>
            <?php echo $form->textField($model, 'work_site', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'work_site'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'courses_page'); ?>
            <?php echo $form->dropDownList($model, 'courses_page', Course::getCourseTitlesList(),
                array('class' => "form-control", 'style' => 'width:350px')); ?>
            <?php echo $form->error($model, 'courses_page'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'history'); ?>
            <?php echo $form->textField($model, 'history', array('size' => 60, 'maxlength' => 255, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'history'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'rate'); ?>
            <?php echo $form->textField($model, 'rate', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'rate'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'recall'); ?>
            <?php echo $form->textArea($model, 'recall', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
            <?php echo $form->error($model, 'recall'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'first_name_en'); ?>
            <?php echo $form->textField($model, 'first_name_en', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'first_name_en'); ?>
            <a href="#"
               onclick="translateName('<?= $model->isNewRecord ? "" : $model->first_name; ?>', '#Graduate_first_name_en', '#Graduate_first_name'); return false;">
                Згенерувати автоматично</a>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'last_name_en'); ?>
            <?php echo $form->textField($model, 'last_name_en', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'last_name_en'); ?>
            <a href="#"
               onclick="translateName('<?= $model->isNewRecord ? "" : $model->last_name; ?>', '#Graduate_last_name_en', '#Graduate_last_name'); return false;">
                Згенерувати автоматично</a>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'first_name_ru'); ?>
            <?php echo $form->textField($model, 'first_name_ru', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'first_name_ru'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'last_name_ru'); ?>
            <?php echo $form->textField($model, 'last_name_ru', array('class' => "form-control")); ?>
            <?php echo $form->error($model, 'last_name_ru'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', array('class' => 'btn btn-primary', 'id' => 'submitButton')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
