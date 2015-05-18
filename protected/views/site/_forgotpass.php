<?php
$rForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'recovery-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('site/recoverypass'),
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
        <?php echo $form->textField($rForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
        <span><?php echo $form->error($rForm,'email'); ?></span>
    </div>
    </br>
    <div class="rowRecovButt">
        <?php $labelButton = Yii::t('forgotpass','0291')?>
        <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
