<?php

$changeForm = $this->beginWidget('CActiveForm', array(
    'id' => 'change-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>false,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true),
    'action' => array('profile/activateMail'),
    'htmlOptions' => array('name'=>'activateMail', 'novalidate'=>true),
));
?>
<div class="signIn">

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0171');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($model,'mail_password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20, "required"=>true, 'ng-model'=>"pw1")); ?></span>
        <span><?php echo $changeForm->error($model,'password'); ?></span>
        <div class="clientValidationError" ng-show="changePass['Teacher[password]'].$dirty && changePass['Teacher[password]'].$invalid">
            <span ng-cloak ng-show="changePass['Teacher_mail_password'].$error.required"><?php echo Yii::t('error','0268') ?></span>
        </div>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regexp', '0172');?>
        <span class="passEye"> <?php echo $changeForm->passwordField($model,'mail_password_repeat',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20, "required"=>true, 'ng-model'=>"pw2", 'pw-check'=>"pw1")); ?></span>
        <span><?php echo $changeForm->error($model,'mail_password_repeat'); ?></span>
        <div class="clientValidationError" ng-show="changePass['Teacher[new_password_repeat]'].$dirty && changePass['Teacher[mail_password_repeat]'].$invalid">
            <span ng-cloak ng-show="changePass['Teacher[mail_password_repeat]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            <span ng-cloak ng-if="!changePass['Teacher[mail_password_repeat]'].$error.required" ng-show="changePass['Teacher[new_password_repeat]'].$error.pwmatch"><?php echo Yii::t('error','0269') ?></span>
        </div>
    </div>

    <?php $labelButton = Yii::t('regexp', '0267');?>
    <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM", 'ng-disabled'=>'changePass.$invalid')); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
