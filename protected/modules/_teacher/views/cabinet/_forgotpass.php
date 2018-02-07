<?php
$rForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'recovery-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('../site/recoverypass'),
    'htmlOptions' => array('name'=>'recoveryForm','novalidate'=>true),
));
?>
<div class="modalHeader">
    <h1><?php echo Yii::t('forgotpass','0289')?></h1>
</div>
<p>
    <?php echo  Yii::t('forgotpass','0290')?>
</p>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->emailField($rForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>40, 'onKeyUp'=>"hideServerValidationMes(this)", 'ng-model'=>"newPass", "ng-required"=> "true")); ?>
        <?php echo $form->error($rForm,'email'); ?>
        <div class="clientValidationError" ng-show="recoveryForm['StudentReg[email]'].$dirty && recoveryForm['StudentReg[email]'].$invalid">
            <span ng-cloak ng-show="recoveryForm['StudentReg[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            <span ng-cloak ng-show="recoveryForm['StudentReg[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
            <span ng-cloak ng-show="recoveryForm['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
        </div>
        <label id="toRegistration" onclick="closeAndReg()" class=registrationWhenForgot ><?php echo Yii::t('registration', '0591'); ?></label>
    </div>
    <br>
    <div class="rowRecovButt">
        <?php $labelButton = Yii::t('forgotpass','0291')?>
        <?php echo CHtml::submitButton($labelButton, array('class' => "signInButtonM", 'ng-disabled'=>'recoveryForm.$invalid')); ?>
    </div>

</div><!-- form -->
<?php $this->endWidget(); ?>

