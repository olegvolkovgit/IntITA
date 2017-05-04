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
                'name'=>'Graduate'
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
            <?php echo $form->textField($model, 'graduate_date', array('class' => "form-control", 'ng-init'=>'graduateDate="'.$model->graduate_date.'"', 'ng-model'=>"graduateDate", 'ng-pattern'=>'/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/')); ?>
            <?php echo $form->error($model, 'graduate_date'); ?>
            <div ng-cloak  class="errorMessage" ng-show="Graduate['Graduate[graduate_date]'].$invalid">
                <span ng-show="Graduate['Graduate[graduate_date]'].$error.pattern"><?php echo Yii::t('graduate','0749') ?></span>
            </div>
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
            <?php
            if($model->isNewRecord) echo $form->textField($model, 'first_name_ru', array('class' => "form-control", 'value'=>''));
            else echo $form->textField($model, 'first_name_ru', array('class' => "form-control"));
            ?>
            <?php echo $form->error($model, 'first_name_ru'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'last_name_ru'); ?>
            <?php
            if($model->isNewRecord) echo $form->textField($model, 'last_name_ru', array('class' => "form-control", 'value'=>''));
            else echo $form->textField($model, 'last_name_ru', array('class' => "form-control"));
            ?>
            <?php echo $form->error($model, 'last_name_ru'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', array('class' => 'btn btn-primary', 'id' => 'submitButton', 'ng-disabled'=>'Graduate.$invalid')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
<script>
    $jq(document).ready(function () {
        $jq("#Graduate_graduate_date").datepicker(lang);
    });
    function translateName(source, id, sourceId) {
        if(!source) source = $jq(sourceId).val();
        $jq(id).val(toEnglish(source));
    }
</script>