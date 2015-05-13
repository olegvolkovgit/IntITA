<!-- regform -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/regform.css"/>
<!-- regform -->
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
    <h1><?php echo 'Відновлення паролю' ?></h1>
</div>
<p>
    Щоб відновити пароль, введіть свою адресу електронної пошти нижче.
    На данну електронну пошту буде відправлено посиланням для відновлення паролю. Термін дії посилання 30 хв.
</p>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->textField($rForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
        <span><?php echo $form->error($rForm,'email'); ?></span>
    </div>
    </br>
    <div class="rowRecovButt">
        <?php $labelButton = 'ВІДПРАВИТИ />'?>
        <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
