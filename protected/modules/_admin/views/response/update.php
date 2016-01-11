<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/response/index');?>">Відгуки викладачів - Головна</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/response/view', array('id' => $model->id));?>">Переглянути відгук</a>

    <div class="page-header">
    <h1>Редагувати відгук #<?php echo $model->id; ?></h1>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'response-form',
            'htmlOptions'=>array(
                'class'=>'formatted-form',
                'enctype'=>'multipart/form-data',
                'method'=>'POST',
            ),
            'action' => Config::getBaseUrl().'/_admin/response/updateResponseText/id/'.$model->id,
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'text'); ?>
            <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50,'class'=>"form-control")); ?>
            <?php echo $form->error($model,'text'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'is_checked'); ?>
            <?php echo $form->dropDownList($model, 'is_checked',array('1' => 'публікувати', '0' => 'приховати'),
                array('class'=>"form-control")); ?>
            <?php echo $form->error($model,'is_checked'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Зберегти'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
