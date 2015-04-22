<!-- regform -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/regform.css"/>
<!-- regform -->
<?php
$qForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
'id' => 'quick-form',
'enableClientValidation' => true,
'enableAjaxValidation'=>true,
'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
'action' => array('site/login'),
));
?>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform','0014');?>
        <?php echo $form->textField($qForm,'email',array('class'=>'signInEmailM','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
        <span><?php echo $form->error($qForm,'email'); ?></span>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regform','0015');?>
        <span class="passEye"> <?php echo $form->passwordField($qForm,'password',array('class'=>'signInPassM','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>255)); ?></span>
        <span><?php echo $form->error($qForm,'password'); ?></span>
        <?php if(Yii::app()->user->hasFlash('info')):
            echo Yii::app()->user->getFlash('info');
        endif; ?>
    </div>

    <div class="forgotPass">
        <?php echo CHtml::link(Yii::t('regform','0092'), '#', array('id'=>'forgotPass',)); ?>
    </div>
    <?php $labelButton = Yii::t('regform',Yii::t('regform','0093'));?>
    <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM")); ?>


    <div class="linesignInForm"><?php echo Yii::t('regform','0091'); ?></div>
    <div class="image" >
            <script src="//ulogin.ru/js/ulogin.js"></script>
            <div id="uLogin" x-ulogin-params="display=buttons;fields=email;
								redirect_uri=<?php echo Yii::app()->request->baseUrl.'/site/sociallogin'?>">
                <ul id="uLoginImages">
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/facebook2.png" x-ulogin-button = "facebook" title = "Facebook"/></li>
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/googleplus2.png" x-ulogin-button = "googleplus" title = "Google +"/></li>
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/linkedin2.png" x-ulogin-button = "linkedin" title = "LinkedIn"/></li>
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/vkontakte2.png" x-ulogin-button = "vkontakte" title = "Вконтакте"/></li>
                    <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/twitter2.png" x-ulogin-button = "twitter" title = "Twitter"/></li>
                </ul>
            </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
