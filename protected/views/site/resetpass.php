<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'recovery.css'); ?>"/>
<?php
$this->breadcrumbs=array(Yii::t('resetpass','0285'));
$chForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'changep-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
));
?>
<div class="recoveryForm">
    <div class="recoveryHeader">
        <h1><?php echo Yii::t('resetpass','0285') ?></h1>
    </div>
    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0264');?>
        <span class="passEye"> <?php echo $form->passwordField($chForm,'new_password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20)); ?></span>
        <span><?php echo $form->error($chForm,'new_password'); ?></span>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0265');?>
        <span class="passEye"> <?php echo $form->passwordField($chForm,'new_password_repeat',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20)); ?></span>
        <span><?php echo $form->error($chForm,'new_password_repeat'); ?></span>
    </div>
    <?php echo CHtml::hiddenField('tokenhid' , $model->getToken(), array('id' => 'hiddenInput')); ?>

    <?php $labelButton = Yii::t('regexp', '0267');?>
    <?php echo CHtml::submitButton($labelButton, array('class' => "signInButtonM")); ?>
    <?php $this->endWidget(); ?>
</div>