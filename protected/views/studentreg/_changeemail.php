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
    <h1><?php echo 'Зміна email' ?></h1>
</div>
<p>
    Введіть нову електронну пошту в поле нижче.
    На данну електронну пошту буде відправлено посиланням для підтвердження дійсності адреси. Термін дії посилання 30 хв.
</p>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->textField($eForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
        <span><?php echo $form->error($eForm,'email'); ?></span>
    </div>
    </br>
    <div class="rowRecovButt">
        <?php $labelButton = 'ВІДПРАВИТИ />'?>
        <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
