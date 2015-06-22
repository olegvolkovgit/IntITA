<?php
/* @var $model Teacher */
/* @var $form CActiveForm */
// retrieve the models from db
$models = StudentReg::model()->findAll(
    array('condition'=>'role<>1', 'order' => 'id'));

// format models as $key=>$value with listData
$list = CHtml::listData($models,
    'id', 'email');
?>

<link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'teacher-form',
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

    <div class="row">
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'middle_name'); ?>
        <?php echo $form->textField($model,'middle_name',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'middle_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>35,'maxlength'=>35)); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'foto_url'); ?>
        <?php echo $form->fileField($model,'foto_url'); ?>
        <?php echo $form->error($model,'foto_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'profile_text_first'); ?>
        <?php echo $form->textArea($model,'profile_text_first',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'profile_text_first'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'profile_text_short'); ?>
        <?php echo $form->textArea($model,'profile_text_short',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'profile_text_short'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'profile_text_last'); ?>
        <?php echo $form->textArea($model,'profile_text_last',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'profile_text_last'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'tel'); ?>
        <?php echo $form->textField($model,'tel',array('size'=>60,'maxlength'=>13)); ?>
        <?php echo $form->error($model,'tel'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'skype'); ?>
        <?php echo $form->textField($model,'skype',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'skype'); ?>
    </div>

    <?php if($scenario == "create"){?>
        <div class="row">
            <?php echo $form->labelEx($model,'user_id'); ?>
            <?php echo $form->dropDownList($model, 'user_id',
                $list,
                array('empty' => '(Виберіть користувача)'));?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
    <?php }?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->