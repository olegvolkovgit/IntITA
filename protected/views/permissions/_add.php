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
    <a name="form" id="label">Додати новий запис</a>
<?php $form=$this->beginWidget('CActiveForm', [
    'id'=>'add-access',
    'action'=>Yii::app()->createUrl('permissions/newPermission'),
    'clientOptions'=>[
        'validateOnSubmit'=>true
    ]
]); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'Користувач '); ?>
    <?php
    echo $form->dropDownList(
        $model,
        'id_user',
        AccessHelper::getUserInfo(),
        array('empty' => '(Виберіть користувача)')
    );
    ?>
    <?php echo $form->error($model,'id_user'); ?>

<div class="row">
    <?php echo $form->labelEx($model,'Лекція '); ?>
    <?php
    echo $form->dropDownList(
        $model,
        'id_resource',
        AccessHelper::getTitles(),
        array('empty' => '(Виберіть лекцію)')
    );
    ?>
    <?php echo $form->error($model,'id_user'); ?>
</div>
    <br />
    <br />
    <div class="row" id="listCheckBox">
        <?php echo $form->labelEx($model,'rights'); ?>
        <?php echo $form->checkBoxList($model,'rights',
            array(
            1=>'READ',
            2=>'UPDATE',
            3=>'CREATE',
            4=>'DELETE'
        )); ?>
        <?php echo $form->error($model,'rights'); ?>
    </div>
<br />
    <br />
    <?php echo CHtml::submitButton('Додати запис', array('id'=>'submitButton')); ?>
<?php $this->endWidget(); ?>
</div>
