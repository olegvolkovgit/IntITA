<?php
/* @var $model Teacher */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'id'=>'extteacherseach'
    )); ?>

    <div class="row">
        <?php echo $form->label($model,'teacher_id'); ?>
        <?php echo $form->textField($model,'teacher_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>35,'maxlength'=>35)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'middle_name'); ?>
        <?php echo $form->textField($model,'middle_name',array('size'=>35,'maxlength'=>35)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>35,'maxlength'=>35)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'subjects'); ?>
        <?php echo $form->textField($model,'subjects',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'tel'); ?>
        <?php echo $form->textField($model,'tel',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'skype'); ?>
        <?php echo $form->textField($model,'skype',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'rate_knowledge'); ?>
        <?php echo $form->textField($model,'rate_knowledge'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'rate_efficiency'); ?>
        <?php echo $form->textField($model,'rate_efficiency'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'rate_relations'); ?>
        <?php echo $form->textField($model,'rate_relations'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'user_id'); ?>
        <?php echo $form->textField($model,'user_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'isPrint'); ?>
        <?php echo $form->textField($model,'isPrint'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->