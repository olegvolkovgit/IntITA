<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 28.12.2015
 * Time: 13:25
 */
?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'authDialog',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false
    ),
));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => $id,
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
        'action' => array($action),
        'htmlOptions' => array('onsubmit'=>"$('.signInEmailM').val($('.signInEmailM').val().trim())", 'name' => 'authFormDialog', 'novalidate' => true),
    ));
    ?>
    <div ng-cloak class="signIn">
        <input type="hidden" name="formId" value="<?php echo $id ?>">
        <div class="rowemail">
            <?php $placeHolderEmail = Yii::t('regform', '0014'); ?>
            <?php echo $form->emailField($model, 'email', array('class' => 'signInEmailM', 'placeholder' => $placeHolderEmail, 'size' => 60, 'maxlength' => 40, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "dialogEmail", "ng-required" => "true")); ?>
            <?php echo $form->error($model, 'email'); ?>
            <div class="clientValidationError"
                 ng-show="authFormDialog['StudentReg[email]'].$dirty && authFormDialog['StudentReg[email]'].$invalid && !regChecked">
                <span ng-cloak
                      ng-show="authFormDialog['StudentReg[email]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
                <span ng-cloak
                      ng-show="authFormDialog['StudentReg[email]'].$error.email"><?php echo Yii::t('error', '0271') ?></span>
                <span ng-cloak
                      ng-show="authFormDialog['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error', '0271') ?></span>
            </div>
        </div>

        <div class="rowpass">
            <?php $placeHolderPassword = Yii::t('regform', '0015'); ?>
            <span class="passEye">
                <?php echo $form->passwordField($model, 'password', array('class' => 'signInPassM', 'placeholder' => $placeHolderPassword, 'size' => 60, 'maxlength' => 20, 'onKeyUp' => "hideSignServerValidationMes(this)", 'ng-model' => "dialogPass", "ng-required" => "true")); ?>
            </span>
            <?php echo $form->error($model, 'password'); ?>
            <div class="clientValidationError"
                 ng-show="authFormDialog['StudentReg[password]'].$dirty && authFormDialog['StudentReg[password]'].$invalid && !regChecked">
                <span ng-cloak
                      ng-show="authFormDialog['StudentReg[password]'].$error.required"><?php echo Yii::t('error', '0268') ?></span>
            </div>
        </div>

        <div ng-show="signModeDialog=='signIn'">
            <div class="authLinks">
                <?php echo CHtml::link(Yii::t('regform', '0092'), '', array('id' => 'authLinks', 'onclick' => 'openForgotpass("fromDialog")')); ?>
                <label for="signUpModeDialog" class=registration><?php echo Yii::t('registration', '0591'); ?></label>
                <input ng-hide=true type="radio" ng-model="signModeDialog" id="signUpModeDialog" name="signMode" value="signUp" />
            </div>
            <?php echo CHtml::submitButton('', array('id' => "signInButtonM", 'ng-disabled' => 'authFormDialog.$invalid', 'value'=>Yii::t('regform', Yii::t('regform', '0093')))); ?>
        </div>
        <div ng-show="signModeDialog=='signUp'">
            <div class="authLinks">
                <div class="regCheckbox">
                    <input type="checkbox" id="regCheckbox" ng-init='regChecked=false' ng-model="regChecked" name="isExtended" />
                    <label for="regCheckbox"><?php echo Yii::t('regform','0011'); ?></label>
                </div>
                <label for="signInModeDialog" class=registration><?php echo Yii::t('regform','0806') ?></label>
                <input ng-hide=true ng-init="signModeDialog='<?php echo $mode; ?>'" type="radio" ng-model="signModeDialog" name="signMode" id="signInModeDialog" value="signIn" />
            </div>
            <?php echo CHtml::submitButton('', array('id' => "signInButtonM", 'ng-disabled' => 'authFormDialog.$invalid && !regChecked', 'value'=>Yii::t('regform', Yii::t('regform', '0013')))); ?>
        </div>

        <div class="linesignInForm"><?php echo Yii::t('regform', '0091'); ?></div>
        <div class="image">
            <script src="//ulogin.ru/js/ulogin.js"></script>
            <div id="uLogin" x-ulogin-params="display=buttons;fields=;optional=email,first_name,last_name,nickname,bdate,phone,photo_big,city;
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
    </div><!-- form -->
    <?php $this->endWidget();
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
