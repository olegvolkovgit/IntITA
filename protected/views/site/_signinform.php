<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
<!-- regform -->
<?php
$qForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'quick-form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
    'action' => array('site/login'),
    'htmlOptions' => array('name' => 'signIn', 'novalidate' => true),
));
?>
<div class="signIn">
    <div class="rowemail">
        <?php $placeHolderEmail = Yii::t('regform', '0014'); ?>
        <?php echo $form->emailField($qForm, 'email', array('class' => 'signInEmailM', 'placeholder' => $placeHolderEmail, 'size' => 60, 'maxlength' => 40, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "dialogEmail", "ng-required" => "true")); ?>
        <?php echo $form->error($qForm, 'email'); ?>
        <div class="clientValidationError"
             ng-show="signIn['StudentReg[email]'].$dirty && signIn['StudentReg[email]'].$invalid">
            <span ng-cloak
                  ng-show="signIn['StudentReg[email]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
            <span ng-cloak
                  ng-show="signIn['StudentReg[email]'].$error.email"><?php echo Yii::t('error', '0271') ?></span>
            <span ng-cloak
                  ng-show="signIn['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error', '0271') ?></span>
        </div>
    </div>

    <div class="rowpass">
        <?php $placeHolderPassword = Yii::t('regform', '0015'); ?>
        <span class="passEye">
            <?php echo $form->passwordField($qForm, 'password', array('class' => 'signInPassM', 'placeholder' => $placeHolderPassword, 'size' => 60, 'maxlength' => 20, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "dialogPass", "ng-required" => "true")); ?>
        </span>
        <?php echo $form->error($qForm, 'password'); ?>
        <div class="clientValidationError"
             ng-show="signIn['StudentReg[password]'].$dirty && signIn['StudentReg[password]'].$invalid">
            <span ng-cloak
                  ng-show="signIn['StudentReg[password]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
        </div>
    </div>

    <div class="forgotPass">
        <?php echo CHtml::link(Yii::t('regform', '0092'), '#', array('id' => 'forgotPass', 'onclick' => 'openForgotpass()')); ?>
        <?php echo CHtml::link(Yii::t('registration', '0591'), Yii::app()->createUrl('site/index', array()) . "#form", array('id' => 'registration', 'onclick' => '$("#mydialog").dialog("close");')); ?>
    </div>

    <?php $labelButton = Yii::t('regform', Yii::t('regform', '0093')); ?>
    <?php echo CHtml::submitButton($labelButton, array('id' => "signInButtonM", 'ng-disabled' => 'signIn.$invalid')); ?>


    <div class="linesignInForm"><?php echo Yii::t('regform', '0091'); ?></div>
    <div class="image">
        <script src="//ulogin.ru/js/ulogin.js"></script>
        <div id="uLogin" x-ulogin-params="display=buttons;fields=;optional=email,first_name,last_name,nickname,phone,photo_big,city;
								redirect_uri=<?php echo Config::getBaseUrl() . '/site/sociallogin' ?>">
            <ul id="uLoginImages">
                <li><img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'facebook2.png'); ?>"
                         x-ulogin-button="facebook" title="Facebook"/></li>
                <li><img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'googleplus2.png'); ?>"
                         x-ulogin-button="googleplus" title="Google +"/></li>
                <li><img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'linkedin2.png'); ?>"
                         x-ulogin-button="linkedin" title="LinkedIn"/></li>
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'vkontakte2.png'); ?><!--"-->
<!--                         x-ulogin-button="vkontakte" title="Вконтакте"/></li>-->
                <li><img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'twitter2.png'); ?>"
                         x-ulogin-button="twitter" title="Twitter"/></li>
            </ul>
        </div>
    </div>
</div><!-- form -->
<?php $this->endWidget(); ?>
