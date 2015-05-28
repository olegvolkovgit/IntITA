<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.05.2015
 * Time: 13:32
 */
?>

<div id="addAccess">
    <br>
    <a name="form">Додати новий запис</a>
<?php $form=$this->beginWidget('CActiveForm', [
    'id'=>'add-access',
    'action'=>Yii::app()->createUrl('permissions/newPermission'),
    'enableAjaxValidation'=>true,
    'clientOptions'=>[
        'validateOnSubmit'=>true
    ]
]); ?>
<p class="note">Поля з <span class="required">*</span> обов'язкові.</p>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'User ID'); ?>
    <?php
    echo $form->dropDownList(
        $model,
        'id_user',
        CHtml::listData( $model->findAll(),'id_user','id_user' ),
        [
            'class' => 'my-drop-down',
            'options' => [
                '2' => [ 'selected' => true ]
            ]
        ]);
    ?>
    <?php echo $form->error($model,'id_user'); ?>

<br />
<div class="row">
    <?php echo $form->labelEx($model,'Resource ID'); ?>
    <?php
    echo $form->dropDownList(
        $model,
        'id_resource',
        CHtml::listData( $model->findAll(),'id_resource','id_resource' ),
        [
            'class' => 'my-drop-down',
            'options' => [
                '2' => [ 'selected' => true ]
            ]
        ]);
    ?>
    <?php echo $form->error($model,'id_user'); ?>
</div>
<br />
    <div class="row">
        <?php echo $form->labelEx($model,'rights'); ?>
        <?php //echo $form->checkBoxList($model,'rights', CHtml::listData(AccessHelper::get)); ?>
        <?php echo $form->error($model,'rights'); ?>
    </div>
<br />
<!--<div id="enter_button_2">-->
    <?php echo CHtml::submitButton('Додати запис', array('id'=>'submitButton')); ?>
<!--</div>-->
<?php $this->endWidget(); ?>
</div>
