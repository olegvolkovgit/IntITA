<?php
/* @var $this CarouselController */
/* @var $model Carousel */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="form-group">
        <?php echo $form->label($model, 'order', array('for' => 'text')); ?>
        <?php echo $form->textField($model, 'order', array('class' => 'form-control', 'id' => 'text')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'pictureURL', array('for' => 'picture')); ?>
        <?php echo $form->textField($model, 'pictureURL', array('size' => 50, 'maxlength' => 50, 'class' =>
            'form-control', 'id' => 'picture')); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->