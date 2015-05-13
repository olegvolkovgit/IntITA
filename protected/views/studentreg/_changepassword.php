<?php
$chForm = new StudentReg;

$changeForm = $this->beginWidget('CActiveForm', array(
    'id' => 'change-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('studentreg/changepass'),
));
?>
<div class="signIn">
    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0263');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>255)); ?></span>
        <span><?php echo $changeForm->error($chForm,'password'); ?></span>
    </div>
    </br>
    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0264');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'new_password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>255)); ?></span>
        <span><?php echo $changeForm->error($chForm,'new_password'); ?></span>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0265');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'new_password_repeat',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>255)); ?></span>
        <span><?php echo $changeForm->error($chForm,'new_password_repeat'); ?></span>
    </div>

    <div class="forgotPass">
        <?php echo CHtml::link(Yii::t('regform','0092'), '#', array('id'=>'forgotPass','onclick' => '$("#forgotpass").dialog("open"); return false;')); ?>
    </div>
    <?php $labelButton = Yii::t('regexp', '0267');?>
    <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
