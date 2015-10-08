<?php
/* @var $this CoursemanageController */
/* @var $model Course */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl().'/css/formattedForm.css';?>"/>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'course-form',
        'htmlOptions'=>array(
            'class'=>'formatted-form',
            'enctype'=>'multipart/form-data',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->dropDownList($model,'language',array(
            'ua'=>'Українська','en'=>'English','ru'=>'Русский'),
            array('options'=>array('ua'=>array('selected'=>true)))); ?>
        <?php echo $form->error($model,'language'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ua'); ?>
        <?php echo $form->textField($model,'title_ua',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'title_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ru'); ?>
        <?php echo $form->textField($model,'title_ru',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'title_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_en'); ?>
        <?php echo $form->textField($model,'title_en',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'title_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'alias'); ?>
        <?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'alias'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'course_duration_hours'); ?>
        <?php echo $form->textField($model,'course_duration_hours',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'course_duration_hours'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'course_number'); ?>
        <?php echo $form->textField($model,'course_number',array('size'=>45,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'course_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'level'); ?>
        <?php echo $form->dropDownList($model, 'level', array('intern'=> Yii::t('courses', '0232'), 'junior' => Yii::t('courses', '0233'),'strong junior' => Yii::t('courses', '0234'), 'middle' => Yii::t('courses', '0235'), 'senior' => Yii::t('courses', '0236')),array('options'=>array('intern'=>array('selected'=>true))));?>
        <?php echo $form->error($model,'level'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'start'); ?>
        <?php echo $form->textField($model,'start',array('placeholder'=>Yii::t('coursemanage', '0395'))); ?>
        <?php echo $form->error($model,'start'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array(
            '0'=>Yii::t('coursemanage', '0396'),'1'=>Yii::t('coursemanage', '0397')),
            array('options'=>array('0'=>array('selected'=>true)))); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'course_price'); ?>
        <?php echo $form->textField($model,'course_price',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'course_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'for_whom_ua'); ?>
        <?php echo $form->textArea($model,'for_whom_ua',array('placeholder'=>Yii::t('coursemanage', '0417'), 'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'for_whom_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_learn_ua'); ?>
        <?php echo $form->textArea($model,'what_you_learn_ua',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_learn_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_get_ua'); ?>
        <?php echo $form->textArea($model,'what_you_get_ua',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_get_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'for_whom_en'); ?>
        <?php echo $form->textArea($model,'for_whom_en',array('placeholder'=>Yii::t('coursemanage', '0417'), 'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'for_whom_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_learn_en'); ?>
        <?php echo $form->textArea($model,'what_you_learn_en',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_learn_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_get_en'); ?>
        <?php echo $form->textArea($model,'what_you_get_en',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_get_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'for_whom_ru'); ?>
        <?php echo $form->textArea($model,'for_whom_ru',array('placeholder'=>Yii::t('coursemanage', '0417'), 'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'for_whom_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_learn_ru'); ?>
        <?php echo $form->textArea($model,'what_you_learn_ru',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_learn_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_get_ru'); ?>
        <?php echo $form->textArea($model,'what_you_get_ru',array('placeholder'=>Yii::t('coursemanage', '0417'),'rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_get_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'course_img'); ?>
        <?php echo $form->fileField($model,'course_img'); ?>
        <?php echo $form->error($model,'course_img'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->