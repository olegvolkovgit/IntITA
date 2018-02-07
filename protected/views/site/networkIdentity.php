<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.11.2015
 * Time: 22:58
 */
if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$eForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'emailVerification-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('site/emailVerification'),
    'htmlOptions' => array('name'=>'emailVerification','novalidate'=>true),
));
?>
<p>
    <?php echo Yii::t('verification','0778'); ?>
</p>
<div class="signIn">
    <?php echo $form->hiddenField($eForm,'identity',array('value'=>$identity)); ?>
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->emailField($eForm,'email',array('placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>40, 'ng-model'=>"verificationEmail", "ng-required"=> "true", 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
        <?php echo $form->error($eForm,'email'); ?>
        <div class="clientValidationError" ng-show="emailVerification['StudentReg[email]'].$dirty && emailVerification['StudentReg[email]'].$invalid">
            <span ng-cloak ng-show="emailVerification['StudentReg[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            <span ng-cloak ng-show="emailVerification['StudentReg[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
            <span ng-cloak ng-show="emailVerification['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
        </div>
    </div>
    <br>
    <div class="emailVerButt">
        <?php $labelButton = Yii::t('changeemail','0294'); ?>
        <?php echo CHtml::submitButton($labelButton, array('class' => "signInButtonM", 'ng-disabled'=>'emailVerification.$invalid')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
