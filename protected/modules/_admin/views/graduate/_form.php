<?php
/* @var $this GraduateController */
/* @var $model Graduate */
/* @var $form CActiveForm */
?>
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/translateTeacherName.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'graduate-form',
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
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo $form->fileField($model,'avatar'); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'graduate_date'); ?>
        <?php echo $form->textField($model,'graduate_date'); ?>
        <?php echo $form->error($model,'graduate_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'position'); ?>
        <?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'position'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'work_place'); ?>
        <?php echo $form->textField($model,'work_place',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'work_place'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'work_site'); ?>
        <?php echo $form->textField($model,'work_site',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'work_site'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'courses_page'); ?>
        <?php echo $form->textField($model,'courses_page',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'courses_page'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'history'); ?>
        <?php echo $form->textField($model,'history',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'history'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'rate'); ?>
        <?php echo $form->textField($model,'rate'); ?>
        <?php echo $form->error($model,'rate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'recall'); ?>
        <?php echo $form->textArea($model,'recall',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'recall'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'first_name_en'); ?>
        <?php echo $form->textField($model,'first_name_en'); ?>
        <?php echo $form->error($model,'first_name_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name_en'); ?>
        <?php echo $form->textField($model,'last_name_en'); ?>
        <?php echo $form->error($model,'last_name_en'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $(window).load(
        function () {
            if (document.getElementById("Graduate_first_name_en").value == '') {
                $("#Graduate_first_name_en").val(toEnglish(document.getElementById("Graduate_first_name").value));
            }
            if (document.getElementById("Graduate_last_name_en").value == '') {
                $("#Graduate_last_name_en").val(toEnglish(document.getElementById("Graduate_last_name").value));
            }
        }
    );
</script>