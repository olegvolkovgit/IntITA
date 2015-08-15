<?php
/* @var $this ExternalPaysController */
/* @var $model ExternalPays */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'external-pays-recieveFunds-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'create_date'); ?>
        <?php echo $form->hiddenField($model,'create_date'); ?>
        <?php echo $form->error($model,'create_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'create_user'); ?>
        <?php echo $form->hiddenField($model,'create_user'); ?>
        <?php echo $form->error($model,'create_user'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'source_id'); ?>
        <?php echo $form->dropDownList($model, 'source_id', CHtml::listData(ExternalSources::model()->findAll(), 'source_id', 'Name'))?>
        <?php echo $form->error($model,'source_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(ExternalSources::model()->findAll(), 'source_id', 'Name'))?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pay_date'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'pay_date',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                ),
            ));
        ?>
        <?php echo $form->error($model,'pay_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'summa'); ?>
        <?php echo $form->textField($model,'summa'); ?>
        <?php echo $form->error($model,'summa'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description'); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->