<?php
$eForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'resetemail-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => array('site/resetemail'),
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
        <?php echo $form->textField($eForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
        <span><?php echo $form->error($eForm,'email'); ?></span>
    </div>
    </br>
    <div class="rowRecovButt">
        <?php $labelButton = Yii::t('changeemail','0294')?>
        <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
