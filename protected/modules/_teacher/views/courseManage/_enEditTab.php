<?php
/* @var $model Course
 * @var $scenario string
 */
?>
<br>
<div class="formMargin">
    <div class="form-group">
        <?php echo $form->labelEx($model, 'title_en'); ?>
        <?php echo $form->textField($model, 'title_en', array('size' => 45, 'maxlength' => 100, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'title_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'for_whom_en'); ?>
        <?php echo $form->textArea($model, 'for_whom_en', array('placeholder' => Yii::t('coursemanage', '0417'), 'rows' => 6,
            'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'for_whom_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'what_you_learn_en'); ?>
        <?php echo $form->textArea($model, 'what_you_learn_en', array('placeholder' => Yii::t('coursemanage', '0417'), 'rows' => 6,
            'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'what_you_learn_en'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'what_you_get_en'); ?>
        <?php echo $form->textArea($model, 'what_you_get_en', array('placeholder' => Yii::t('coursemanage', '0417'), 'rows' => 6,
            'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'what_you_get_en'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399'),
            array(
                'class' => 'btn btn-primary',
                'id' => 'submitButton',
            )); ?>
    </div>
</div>