<?php
$eForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'resetemail-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('site/resetemail'),
    'htmlOptions' => array('name'=>'resetEmail','novalidate'=>true),
));
?>
<div class="modalHeader">
    <h1><?php echo Yii::t('changeemail','0292')?></h1>
</div>
<p>
    <?php echo Yii::t('changeemail','0293')?>
</p>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->emailField($eForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>40, 'ng-model'=>"changeEmail", "ng-required"=> "true", 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
        <?php echo $form->error($eForm,'email'); ?>
        <div class="clientValidationError" ng-show="resetEmail['StudentReg[email]'].$dirty && resetEmail['StudentReg[email]'].$invalid">
            <span ng-cloak ng-show="resetEmail['StudentReg[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            <span ng-cloak ng-show="resetEmail['StudentReg[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
            <span ng-cloak ng-show="resetEmail['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
        </div>
    </div>
    <br>
    <div class="rowRecovButt">
        <?php $labelButton = Yii::t('changeemail','0294')?>
        <?php echo CHtml::submitButton($labelButton, array('class' => "signInButtonM", 'ng-disabled'=>'resetEmail.$invalid')); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
