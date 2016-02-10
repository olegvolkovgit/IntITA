<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>
<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?= StaticFilesHelper::fullPathTo('css', 'formattedForm.css') ?>"/>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'carousel-form',
        'htmlOptions' => array(
            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:validateSliderForm',
        )
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові.</p>

    <div class="form-group">
        <p class="note" style="color: #ff0000">Зверніть увагу зображення рекомендовані пропорції 2.18 до 1</p>
        <?php echo $form->labelEx($model, 'pictureURL', array('for' => 'picture')); ?>
        <?php echo $form->fileField($model, 'pictureURL', array('size' => 50, 'maxlength' => 50, 'id' => 'picture','onchange'=>"CheckFile(this)")); ?>
        <div class="errorMessage" style="display: none"></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slider_text', array('for' => 'text')); ?>
        <?php echo $form->textField($model, 'slider_text', array('class' => "form-control", 'id' => 'text')); ?>
        <?php echo $form->error($model, 'slider_text'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти',array('id'=>'submitButton')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<!--<div class="col-md-6">-->
<!--    <form action="--><?php //echo $path ?><!--" method="post" onsubmit="return validateSliderForm();">-->
<!--        <div class="form-group">-->
<!--            <label for="textCode">Код для тексту</label>-->
<!--            <input type="text" class="form-control" name="code" id="textCode" placeholder="Код для тексту">-->
<!--            <div id="errorCode" class=""></div>-->
<!--            <div class="alert alert-danger" id="error" style="display: none"></div>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="exampleInputFile">Виберіть файл</label>-->
<!--            <input type="file" na id="fileInput">-->
<!--            <p class="help-block">Виберіть файл для відображення на головній сторінці.</p>-->
<!--            <div class="alert alert-danger" id="error" style="display: none"></div>-->
<!---->
<!--        </div>-->
<!---->
<!--        <button type="submit" class="btn btn-default">Зберегти</button>-->
<!--    </form>-->
<!--</div>-->