<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', '_admin/aboutus.css') ?>"/>

<div class="col-md-8">

    <form onsubmit="addPicture()"
        <div class="form-group">
            <div class="alert alert-danger">
                Зверніть увагу зображення рекомендовані пропорції 3 до 1
            </div>


        </div>
        <br>

<!--    --><?php //$form = $this->beginWidget('CActiveForm', array(
//        'id' => 'aboutusSliderForm',
//        'htmlOptions' => array(
//            'class' => 'formatted-form',
//            'enctype' => 'multipart/form-data',
//        ),
//        // Please note: When you enable ajax validation, make sure the corresponding
//        // controller action is handling ajax validation correctly.
//        // There is a call to performAjaxValidation() commented in generated controller code.
//        // See class documentation of CActiveForm for details on this.
//        'enableClientValidation'=>true,
//        'enableAjaxValidation' => true,
//        'clientOptions' => array(
//            'validateOnSubmit' => true,
//            'validateOnChange' => false),
//    )); ?>
<!---->
<!---->
<!--    <div class="form-group">-->
<!--        <div class="alert alert-danger">-->
<!--            Зверніть увагу зображення рекомендовані пропорції 3 до 1-->
<!--        </div>-->
<!--        --><?php //echo $form->labelEx($model, 'pictureUrl'); ?>
<!--        --><?php //echo $form->fileField($model, 'pictureUrl'); ?>
<!--        --><?php //echo $form->error($model, 'pictureUrl'); ?>
<!--    </div>-->
<!--    <br>-->
<!---->
<!--    <div class="form-group">-->
<!--        --><?php //echo $form->labelEx($model, 'text', array('for' => 'text')); ?>
<!--        --><?php //echo $form->textField($model, 'text', array('class' => "form-control")); ?>
<!--        --><?php //echo $form->error($model, 'text'); ?>
<!--    </div>-->
<!---->
<!--    <div class="form-group">-->
<!--        --><?php //echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
<!--    </div>-->
<!---->
<!--    --><?php //$this->endWidget(); ?>

</div><!-- form -->