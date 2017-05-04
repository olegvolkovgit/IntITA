<?php
/**
 * @var $model Course
 * @var $levels array
 * @var $level Level
 * @var $scenario string
 */
?>
<br>
<div class="formMargin">
    <div class="form-group">
        <?php echo $form->labelEx($model, 'language'); ?>
        <?php echo $form->dropDownList($model, 'language', array('ua' => 'українською', 'ru' => 'російською',
            'en' => 'англійською'), array('class' => 'form-control', 'disabled'=>$model->isNewRecord?false:true)); ?>
        <?php echo $form->error($model, 'language'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'alias'); ?>
        <?php echo $form->textField($model, 'alias', array('size' => 45, 'maxlength' => 100, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'alias'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'course_number'); ?>
        <?php echo $form->textField($model, 'course_number', array('size' => 45, 'maxlength' => 100, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'course_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'level'); ?>
        <?php echo $form->dropDownList($model, 'level', CHtml::listData(Level::model()->findAll(), 'id', 'title_ua'),
            array('options' => array('1' => array('selected' => true)), 'empty' => 'Виберіть рівень', 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'level'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'start'); ?>
        <?php echo $form->dateField($model, 'start', array('placeholder' => Yii::t('coursemanage', '0395'),
            'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'start'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status_online'); ?>
        <?php echo $form->dropDownList($model, 'status_online', array(
            '0' => Yii::t('coursemanage', '0396'), '1' => Yii::t('coursemanage', '0397')),
            array('options' => array('0' => array('selected' => true)), 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'status_online'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'status_offline'); ?>
        <?php echo $form->dropDownList($model, 'status_offline', array(
            '0' => Yii::t('coursemanage', '0396'), '1' => Yii::t('coursemanage', '0397')),
            array('options' => array('0' => array('selected' => true)), 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'status_offline'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'course_img'); ?>
        <?php echo $form->fileField($model, 'course_img', array('onchange' => "CheckFile(this)")); ?>
        <div class="errorMessage" style="display: none"></div>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399'),
            array(
                'class' => 'btn btn-primary',
                'id' => 'submitButton',
            )); ?>
    </div>
</div>