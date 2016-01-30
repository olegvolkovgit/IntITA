<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
$lg = Yii::app()->session['lg'];
$sources = Level::allTitlesByLang($lg);
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'module-form',
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



    <div class="form-group" style="visibility: hidden; height:0px">
        <?php echo $form->labelEx($model, 'module_ID'); ?>
        <?php echo $form->textField($model, 'module_ID', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'module_number'); ?>
        <?php echo $form->textField($model, 'module_number', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'module_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title_ua'); ?>
        <?php echo $form->textField($model, 'title_ua', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'title_ua'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title_en'); ?>
        <?php echo $form->textField($model, 'title_en', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'title_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title_ru'); ?>
        <?php echo $form->textField($model, 'title_ru', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'title_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'alias'); ?>
        <?php echo $form->textField($model, 'alias', array('size' => 30, 'maxlength' => 30, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'alias'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'language'); ?>
        <?php echo $form->dropDownList($model, 'language', array('ua' => 'українською', 'ru' => 'російською',
            'en' => 'англійською'), array('class' => 'form-control', 'style' => 'width:350px')); ?>
        <?php echo $form->error($model, 'language'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(
            '0' => Yii::t('coursemanage', '0396'), '1' => Yii::t('coursemanage', '0397')),
            array('options' => array('0' => array('selected' => true)), 'class' => 'form-control', 'style' => 'width:350px')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'for_whom'); ?>
        <?php echo $form->textArea($model, 'for_whom', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'for_whom'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'what_you_learn'); ?>
        <?php echo $form->textArea($model, 'what_you_learn', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'what_you_learn'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'what_you_get'); ?>
        <?php echo $form->textArea($model, 'what_you_get', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'what_you_get'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'module_img'); ?>
        <?php echo $form->fileField($model, 'module_img', array('onchange'=>"CheckFile(this)")); ?>
        <div class="errorMessage" style="display: none"></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'level'); ?>
        <?php echo $form->dropDownList($model, 'level', array(
            '1' => $sources[1],
            '2' => $sources[2],
            '3' => $sources[3],
            '4' => $sources[4],
            '5' => $sources[5]),
            array('options' => array('intern' => array('selected' => true)), 'class' => 'form-control', 'style' => 'width:350px')); ?>
        <?php echo $form->error($model, 'level'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'hours_in_day'); ?>
        <?php echo $form->textField($model, 'hours_in_day', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'hours_in_day'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'days_in_week'); ?>
        <?php echo $form->textField($model, 'days_in_week', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'days_in_week'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class' => 'btn btn-primary', 'id'=>'submitButton')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

