<?php
/* @var $model Teacher */
/* @var $form CActiveForm */
// retrieve the models from db
$models = StudentReg::model()->findAll(
    array('condition' => 'role<>1', 'order' => 'id'));

// format models as $key=>$value with listData
$list = CHtml::listData($models,
    'id', 'email');
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'translateTeacherName.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>

<div class="form">
<div class="col-md-4">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'teacher-form',
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
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate' => 'js:function(form,data,hasError){
                send(form,data,hasError);return true;
                }',
        )
    )); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'first_name'); ?>
        <?php echo $form->textField($model, 'first_name',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control','required'=>'true')); ?>
        <?php echo $form->error($model, 'first_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'middle_name'); ?>
        <?php echo $form->textField($model, 'middle_name',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control','required'=>'true')); ?>
        <?php echo $form->error($model, 'middle_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'last_name'); ?>
        <?php echo $form->textField($model, 'last_name',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control','required'=>'true')); ?>
        <?php echo $form->error($model, 'last_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'foto_url'); ?>
        <?php echo $form->fileField($model, 'foto_url', array('onchange'=>"CheckFile(this)")); ?>
        <div class="errorMessage" style="display: none"></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_first'); ?>
        <?php echo $form->textArea($model, 'profile_text_first',
            array('rows' => 6, 'cols' => 50,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'profile_text_first'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_short'); ?>
        <?php echo $form->textArea($model, 'profile_text_short',
            array('rows' => 6, 'cols' => 50,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'profile_text_short'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_last'); ?>
        <?php echo $form->textArea($model, 'profile_text_last',
            array('rows' => 6, 'cols' => 50,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'profile_text_last'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email',
            array('size' => 50, 'maxlength' => 50,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'tel'); ?>
        <?php echo $form->textField($model, 'tel',
            array('size' => 60, 'maxlength' => 13,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'tel'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'skype'); ?>
        <?php echo $form->textField($model, 'skype',
            array('size' => 50, 'maxlength' => 50,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'skype'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'first_name_en'); ?>
        <?php echo $form->textField($model, 'first_name_en',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'first_name_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'middle_name_en'); ?>
        <?php echo $form->textField($model, 'middle_name_en',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'middle_name_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'last_name_en'); ?>
        <?php echo $form->textField($model, 'last_name_en',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'last_name_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'first_name_ru'); ?>
        <?php echo $form->textField($model, 'first_name_ru',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'first_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'middle_name_ru'); ?>
        <?php echo $form->textField($model, 'middle_name_ru',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'middle_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'last_name_ru'); ?>
        <?php echo $form->textField($model, 'last_name_ru',
            array('size' => 35, 'maxlength' => 35,'class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'last_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'isPrint'); ?>
        <?php echo $form->dropDownList($model, 'isPrint',
            array('1' => 'показувати', '0' => 'не показувати'),
            array('class'=> 'form-control')); ?>
        <?php echo $form->error($model, 'isPrint'); ?>
    </div>

    <?php if ($scenario == "create") { ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'user_id'); ?>
            <?php echo $form->dropDownList($model, 'user_id',
                $list,
                array('class'=> 'form-control','required'=>'true','empty' => '(Виберіть користувача)')); ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>
    <?php } ?>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class' => 'btn btn-primary', 'id'=>'submitButton')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
</div><!-- form -->
<script>
    $(window).load(
        function () {
            if (document.getElementById("Teacher_first_name_en").value == '') {
                $("#Teacher_first_name_en").val(toEnglish(document.getElementById("Teacher_first_name").value));
            }
            if (document.getElementById("Teacher_middle_name_en").value == '') {
                $("#Teacher_middle_name_en").val(toEnglish(document.getElementById("Teacher_middle_name").value));
            }
            if (document.getElementById("Teacher_last_name_en").value == '') {
                $("#Teacher_last_name_en").val(toEnglish(document.getElementById("Teacher_last_name").value));
            }
        }
    );
</script>