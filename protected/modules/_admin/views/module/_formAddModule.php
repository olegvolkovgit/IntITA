<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'formattedForm.css')?>"/>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'module-form',
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

    <div class="row" style="visibility: hidden; height:0px">
        <?php echo $form->labelEx($model,'module_ID'); ?>
        <?php echo $form->textField($model,'module_ID',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'module_number'); ?>
        <?php echo $form->textField($model,'module_number'); ?>
        <?php echo $form->error($model,'module_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ua'); ?>
        <?php echo $form->textField($model,'title_ua',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title_ua'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_en'); ?>
        <?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title_en'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title_ru'); ?>
        <?php echo $form->textField($model,'title_ru',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title_ru'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'alias'); ?>
        <?php echo $form->textField($model,'alias',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'alias'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->dropDownList($model, 'language', array('ua'=> 'українською', 'ru' => 'російською','en' => 'англійською')); ?>
        <?php echo $form->error($model,'language'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'module_price'); ?>
        <?php echo $form->textField($model,'module_price',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'module_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'for_whom'); ?>
        <?php echo $form->textArea($model,'for_whom',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'for_whom'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_learn'); ?>
        <?php echo $form->textArea($model,'what_you_learn',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_learn'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'what_you_get'); ?>
        <?php echo $form->textArea($model,'what_you_get',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'what_you_get'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'module_img'); ?>
        <?php echo $form->textField($model,'module_img',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'module_img'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'level'); ?>
        <?php echo $form->dropDownList($model, 'level', array('intern'=> Yii::t('courses', '0232'), 'junior' => Yii::t('courses', '0233'),'strong junior' => Yii::t('courses', '0234'), 'middle' => Yii::t('courses', '0235'), 'senior' => Yii::t('courses', '0236')),array('options'=>array('intern'=>array('selected'=>true))));?>
        <?php echo $form->error($model,'level'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'hours_in_day'); ?>
        <?php echo $form->textField($model,'hours_in_day'); ?>
        <?php echo $form->error($model,'hours_in_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'days_in_week'); ?>
        <?php echo $form->textField($model,'days_in_week'); ?>
        <?php echo $form->error($model,'days_in_week'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->