<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 28.12.2015
 * Time: 13:25
 */
?>
<div class="signInForm">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
    'id' => $id,
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
        'action' => array($action),
    'htmlOptions' => array('onsubmit'=>"$('.signInEmail').val($('.signInEmail').val().trim())", 'name' => 'authForm', 'novalidate' => true),
    ));
    ?>
    <div ng-cloak class="signUp">
        <input type="hidden" name="formId" value="<?php echo $id ?>">
        <input type="hidden" name="callBack" value="<?php echo $callBack ?>">
        <div class="rowemail">
            <?php $placeHolderEmail = Yii::t('regform', '0014'); ?>
            <?php echo $form->emailField($model, 'email', array('class' => 'signInEmail', 'placeholder' => $placeHolderEmail, 'size' => 60, 'maxlength' => 40, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "formEmail", "ng-required" => "true")); ?>
            <?php echo $form->error($model, 'email'); ?>
            <div class="clientValidationError"
                 ng-show="authForm['StudentReg[email]'].$dirty && authForm['StudentReg[email]'].$invalid  && !regChecked">
                    <span ng-cloak
                          ng-show="authForm['StudentReg[email]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
                    <span ng-cloak
                          ng-show="authForm['StudentReg[email]'].$error.email"><?php echo Yii::t('error', '0271') ?></span>
                    <span ng-cloak
                          ng-show="authForm['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error', '0271') ?></span>
            </div>
        </div>

        <div class="rowpass">
            <?php $placeHolderPassword = Yii::t('regform', '0015'); ?>
            <span class="passEye">
                    <?php echo $form->passwordField($model, 'password', array('class' => 'signInPassM', 'placeholder' => $placeHolderPassword, 'size' => 60, 'maxlength' => 20, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "formPass", "ng-required" => "true")); ?>
                </span>
            <?php echo $form->error($model, 'password'); ?>
            <div class="clientValidationError"
                 ng-show="authForm['StudentReg[password]'].$dirty && authForm['StudentReg[password]'].$invalid  && !regChecked">
                    <span ng-cloak
                          ng-show="authForm['StudentReg[password]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
            </div>
        </div>
        <div ng-show="signMode=='signIn'">
            <div class="authLinks">
                <?php echo CHtml::link(Yii::t('regform', '0092'), '', array('id' => 'authLinks', 'onclick' => 'openForgotpass("fromForm")')); ?>
                <label for="signUpMode" class=registration><?php echo Yii::t('registration', '0591'); ?></label>
                <input ng-hide=true type="radio" ng-model="signMode" id="signUpMode" name="signMode" value="signUp" />
            </div>
            <?php echo CHtml::submitButton('', array('id' => "signInButtonM", 'ng-disabled' => 'authForm.$invalid', 'value'=>Yii::t('regform', Yii::t('regform', '0093')))); ?>
        </div>
        <div ng-show="signMode=='signUp'">
            <div class="authLinks">
                <div class="regCheckbox">
                    <input type="checkbox" id="regCheckbox" ng-init='regChecked=false' ng-model="regChecked" name="isExtended" />
                    <label for="regCheckbox"><?php echo Yii::t('regform','0011'); ?></label>
                </div>
                <label for="signInMode" class=registration><?php echo Yii::t('regform','0806') ?></label>
                <input ng-hide=true ng-init="signMode='<?php echo $mode; ?>'" type="radio" ng-model="signMode" name="signMode" id="signInMode" value="signIn" />
            </div>
            <?php echo CHtml::submitButton('', array('id' => "signInButtonM", 'ng-disabled' => 'authForm.$invalid && !regChecked', 'value'=>Yii::t('regform', Yii::t('regform', '0013')))); ?>
        </div>

        <div class="linesignInForm"><?php echo Yii::t('regform', '0091'); ?></div>
        <div class="image">
            <script src="//ulogin.ru/js/ulogin.js"></script>
            <div id="uReg" x-ulogin-params="display=buttons;fields=;optional=email,first_name,last_name,nickname,bdate,phone,photo_big,city;
                                        redirect_uri=<?php echo Config::getBaseUrl() . '/site/sociallogin' ?>">
                <div id="uLoginImages">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'facebook2.png'); ?>"
                             x-ulogin-button="facebook" title="Facebook"/>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'googleplus2.png'); ?>"
                             x-ulogin-button="googleplus" title="Google +"/>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'linkedin2.png'); ?>"
                             x-ulogin-button="linkedin" title="LinkedIn"/>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'vkontakte2.png'); ?>"
                            x-ulogin-button="vkontakte" title="Вконтакте"/>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'signin', 'twitter2.png'); ?>"
                             x-ulogin-button="twitter" title="Twitter"/>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
