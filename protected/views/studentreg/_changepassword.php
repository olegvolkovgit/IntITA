<?php
$chForm = new StudentReg;

$changeForm = $this->beginWidget('CActiveForm', array(
    'id' => 'change-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('studentreg/changepass'),
    'htmlOptions' => array('name'=>'changePass', 'novalidate'=>true),
));
?>
<div class="signIn">
    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0263');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20, "required"=>true, 'ng-model'=>"pass", 'onKeyUp'=>"hidePassServerValidationMes(this)")); ?></span>
        <?php echo $changeForm->error($chForm,'password'); ?>
        <div class="clientValidationError" ng-show="changePass['StudentReg[password]'].$dirty && changePass['StudentReg[password]'].$invalid">
            <span ng-cloak ng-show="changePass['StudentReg[password]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
        </div>
    </div>
    <br>
    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0264');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'new_password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20, "required"=>true, 'ng-model'=>"pw1")); ?></span>
        <span><?php echo $changeForm->error($chForm,'new_password'); ?></span>
        <div class="clientValidationError" ng-show="changePass['StudentReg[new_password]'].$dirty && changePass['StudentReg[new_password]'].$invalid">
            <span ng-cloak ng-show="changePass['StudentReg[new_password]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
        </div>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0265');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($chForm,'new_password_repeat',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20, "required"=>true, 'ng-model'=>"pw2", 'pw-check'=>"pw1")); ?></span>
        <span><?php echo $changeForm->error($chForm,'new_password_repeat'); ?></span>
        <div class="clientValidationError" ng-show="changePass['StudentReg[new_password_repeat]'].$dirty && changePass['StudentReg[new_password_repeat]'].$invalid">
            <span ng-cloak ng-show="changePass['StudentReg[new_password_repeat]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            <span ng-cloak ng-if="!changePass['StudentReg[new_password_repeat]'].$error.required" ng-show="changePass['StudentReg[new_password_repeat]'].$error.pwmatch"><?php echo Yii::t('error','0269') ?></span>
        </div>
    </div>

    <div class="forgotPass">
        <?php echo CHtml::link(Yii::t('regform','0092'), '#', array('id'=>'forgotPass','onclick' => '$("#forgotpass").dialog("open"); return false;')); ?>
    </div>
    <?php $labelButton = Yii::t('regexp', '0267');?>
    <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM", 'ng-disabled'=>'changePass.$invalid')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
