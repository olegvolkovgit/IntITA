<? $css_version = 1; ?>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-select/select.min.css'); ?>"/>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/bootstrap.min.css'); ?>">
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'studProfile.css'); ?>"/>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'uploadInfo.js'); ?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
<?php
/* @var $this StudentRegController */
/* @var $model StudentReg */
/* @var $regExtended Regextended */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0056'),
);
$param = Yii::app()->session["lg"]?"title_".Yii::app()->session["lg"]:"title_ua";
?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'rolesReg.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.extensions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.numeric.extensions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.custom.extensions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/mask.js'); ?>"></script>
<!--StyleForm Check and radio box-->
<link href="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/jquery.formstyler.css'); ?>" rel="stylesheet"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/jquery.formstyler.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/inputstyler.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select.min.css'); ?>" rel="stylesheet"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/countryCityServices.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/specializationsServices.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/careerService.js'); ?>"></script>
<!--StyleForm Check and radio box-->
<script>
    basePath = '<?php echo Config::getBaseUrl(); ?>';
</script>
<div class="formStudProf" ng-cloak >
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'registration-form',
        'action' => array('studentreg/registration'),
        'enableClientValidation'=>true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,
            'afterValidate' => 'js:function(){if($("div").is(".rowNetwork.error"))
             $(".tabs").lightTabs("1"); else if($("div").is(".error")){ $(".tabs").lightTabs("0");} return true;}',),
        'htmlOptions' => array('enctype' => 'multipart/form-data', 'ng-submit'=>"sendForm(dataForm)", 'name'=>'StudentReg', 'ng-controller'=>"registrationFormController", 'novalidate'=>true),
    )); ?>
    <?php
    if (!isset($email)) $email = $_POST['StudentReg']['email'];
    ?>
    <div class="rightProfileColumn">
        <div class="studPhoto">
            <table class="titleProfileAv">
                <tr>
                    <td>
                        <h2><?php echo Yii::t('regexp', '0156'); ?></h2>
                    </td>
                </tr>
            </table>
            <img class='avatarimg' ng-if="!myImage || StudentReg.$error.size || StudentReg.$error.fileType"
                 src="<?php echo StaticFilesHelper::createPath('image', 'avatars', 'noname.png'); ?>"/>
            <div class="cropArea avatarimg" ng-show="myImage && !StudentReg.$error.size && !StudentReg.$error.fileType">
                <img-crop image="myImage" ng-init="myCroppedImage=''" result-image="myCroppedImage" area-type="square"></img-crop>
            </div>
            <div class="fileform">
                <input type="file" tabindex='-1' id="chooseAvatar" max-file-size="5242880" ng-model="attachment" file-check="" />
                <input type="hidden" name="avatar">
                <label id="avatar" for="chooseAvatar"><?php echo Yii::t('regexp', '0157'); ?></label>
            </div>
            <div id="avatarHelp"><?php echo Yii::t('regexp', '0158'); ?></div>
            <div id="avatarInfo"><?php echo Yii::t('regexp', '0159'); ?></div>
            <div ng-cloak class="clientValidationError" ng-show="StudentReg.$error.size || StudentReg.$error.fileType">
                <div ng-cloak ng-show="StudentReg.$error.size"><?php echo Yii::t('error','0302'); ?></div>
                <div ng-cloak ng-show="StudentReg.$error.fileType"><?php echo Yii::t('error','0672'); ?></div>
            </div>
            <div class="avatarError">
                <?php echo $form->error($model, 'avatar'); ?>
            </div>
        </div>
    </div>
    <div class="studProf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php echo Yii::t('regexp', '0150'); ?></h2>
                </td>
            </tr>
        </table>
        <div class="tabs">
            <ul>
                <li>
                    <?php echo Yii::t('regexp', '0562'); ?>
                </li>
                <li ng-click="uiSelectInit()">
                    <?php echo Yii::t('regexp', '0563'); ?>
                </li>
                <li ng-click="uiSelectInit()">
                    <?php echo Yii::t('regexp', '0919'); ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="mainreg">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'firstName'); ?>
                        <?php echo $form->textField($model, 'firstName', array('ng-model'=>"firstName", 'maxlength' => 20, 'autofocus' => 'true', 'ng-pattern'=>'/^[a-zа-яіїёA-ZА-ЯІЇЁєЄ\s\'’]+$/', 'placeholder' => Yii::t('regexp', '0160'))); ?>
                        <span><?php echo $form->error($model, 'firstName'); ?></span>
                        <div ng-cloak class="clientValidationError" ng-show="StudentReg['StudentReg[firstName]'].$invalid">
                            <span ng-cloak ng-show="StudentReg['StudentReg[firstName]'].$error.pattern"><?php echo Yii::t('error','0416') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'secondName'); ?>
                        <?php echo $form->textField($model, 'secondName', array('maxlength' => 20,'ng-model'=>"secondName", 'ng-pattern'=>'/^[a-zа-яіїёA-ZА-ЯІЇЁєЄ\s\'’]+$/', 'placeholder' => Yii::t('regexp', '0162'))); ?>
                        <span><?php echo $form->error($model, 'secondName'); ?></span>
                        <div ng-cloak  class="clientValidationError" ng-show="StudentReg['StudentReg[secondName]'].$invalid">
                            <span ng-show="StudentReg['StudentReg[secondName]'].$error.pattern"><?php echo Yii::t('error','0416') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'nickname'); ?>
                        <?php echo $form->textField($model, 'nickname', array('maxlength' => 20, 'placeholder' => Yii::t('regexp', '0163'))); ?>
                        <span><?php echo $form->error($model, 'nickname'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'birthday'); ?>
                        <?php echo $form->textField($model, 'birthday', array('maxlength' => 11, 'class' => 'date', 'placeholder' => Yii::t('regexp', '0152'))); ?>
                        <span><?php echo $form->error($model, 'birthday'); ?></span>
                    </div>
                    <div class="row selectRow">
                        <?php echo $form->label($model, 'country'); ?>
                        <div class="selectBox">
                            <oi-select
                                oi-options="country.title for country in countriesList track by country.id"
                                ng-model="dataForm.selectedCountry"
                                single
                                oi-select-options="{cleanModel: true}"
                                placeholder="<?php echo Yii::t('regexp', '0896'); ?>"
                                class="indicator"
                                id="countrySelect"
                            ></oi-select>
                        </div>
                        <span><?php echo $form->error($model, 'country'); ?></span>
                        <?php echo $form->hiddenField($model, 'country'); ?>
                    </div>
                    <div ng-show="dataForm.selectedCountry" class="row selectRow">
                        <?php echo $form->label($model, 'city'); ?>
                        <div class="selectBox">
                            <oi-select
                                oi-options="city.title for city in dataForm.citiesList track by city.id"
                                ng-model="dataForm.selectedCity"
                                single
                                oi-select-options="{
                                cleanModel: true,
                                newItem: 'prompt',
                                newItemModel: {id: null, title: $query},
                                maxlength:50
                                }"
                                placeholder="<?php echo Yii::t('regexp', '0898'); ?>"
                                class="indicator"
                                id="citySelect"
                            ></oi-select>
                        </div>
                        <input type="hidden" name="cityTitle">
                        <span><?php echo $form->error($model, 'city'); ?></span>
                        <?php echo $form->hiddenField($model, 'city'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'address'); ?>
                        <?php echo $form->textField($model, 'address', array('maxlength' => 100, 'placeholder' => Yii::t('regexp', '0166'))); ?>
                        <span><?php echo $form->error($model, 'address'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'phone'); ?>
                        <?php echo $form->textField($model, 'phone', array('class' => 'phone', 'maxlength' => 15,'minlength' => 15, 'placeholder' => Yii::t('regexp', '0165'))); ?>
                        <span><?php echo $form->error($model, 'phone'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <?php echo $form->emailField($model, 'email', array('ng-init'=>"email='$email'",'ng-model'=>"email",'maxlength' => 40, "required"=>true, 'onKeyUp'=>"hideServerValidationMes(this)", 'placeholder' => Yii::t('regexp', '0242'))); ?>
                        <?php echo $form->error($model, 'email'); ?>
                        <div ng-cloak class="clientValidationError" ng-show="StudentReg['StudentReg[email]'].$dirty && StudentReg['StudentReg[email]'].$invalid">
                            <span ng-show="StudentReg['StudentReg[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="StudentReg['StudentReg[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
                            <span ng-show="StudentReg['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <span class="passEye"><?php echo $form->passwordField($model, 'password', array('maxlength' => 20, "required"=>true, 'ng-model'=>"pw1", 'placeholder' => Yii::t('regexp', '0171'))); ?></span>
                        <?php echo $form->error($model, 'password'); ?>
                        <div ng-cloak class="clientValidationError" ng-show="StudentReg['StudentReg[password]'].$dirty && StudentReg['StudentReg[password]'].$invalid">
                            <span ng-show="StudentReg['StudentReg[password]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password_repeat'); ?>
                        <span class="passEye"> <?php echo $form->passwordField($model, 'password_repeat', array('maxlength' => 20, "required"=>true, 'ng-model'=>"pw2", 'pw-check'=>"pw1", 'placeholder' => Yii::t('regexp', '0172'))); ?></span>
                        <?php echo $form->error($model, 'password_repeat'); ?>
                        <div ng-cloak class="clientValidationError" ng-show="StudentReg['StudentReg[password_repeat]'].$dirty && StudentReg['StudentReg[password_repeat]'].$invalid">
                            <span ng-show="StudentReg['StudentReg[password_repeat]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-if="!StudentReg['StudentReg[password_repeat]'].$error.required" ng-show="StudentReg['StudentReg[password_repeat]'].$error.pwmatch"><?php echo Yii::t('error','0269') ?></span>
                        </div>
                    </div>
                </div>
                <div id="addreg">
                    <div class="row rowAbout rowTextarea">
                        <?php echo $form->label($model, 'aboutMy'); ?>
                        <?php echo $form->textArea($model, 'aboutMy', array('maxlength' => 500, 'placeholder' => Yii::t('regexp', '0170'))); ?>
                        <?php echo $form->error($model, 'aboutMy'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'interests'); ?>
                        <?php echo $form->textField($model, 'interests', array('maxlength' => 255, 'placeholder' => Yii::t('regexp', '0153'))); ?>
                        <span><?php echo $form->error($model, 'interests'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'education'); ?>
                        <?php echo $form->textField($model, 'education', array('maxlength' => 100, 'placeholder' => Yii::t('regexp', '0167'))); ?>
                        <span><?php echo $form->error($model, 'education'); ?></span>
                    </div>

                    <div class="row  rowTextarea">
                        <?php echo $form->label($model, 'prev_job'); ?>
                        <?php echo $form->textArea($model, 'prev_job', array('maxlength' => 1000, 'placeholder' => Yii::t('regexp', '0920'))); ?>
                        <span><?php echo $form->error($model, 'prev_job'); ?></span>
                    </div>
                    <div class="row  rowTextarea">
                        <?php echo $form->label($model, 'current_job'); ?>
                        <?php echo $form->textArea($model, 'current_job', array('maxlength' => 1000, 'placeholder' => Yii::t('regexp', '0921'))); ?>
                        <span><?php echo $form->error($model, 'current_job'); ?></span>
                    </div>
                    <div class="row rowTextarea">
                        <input type="hidden" name="careers">
                        <label><?php echo Yii::t('regexp', '0923') ?></label>
                        <ui-select multiple ng-model="dataForm.careerStart" theme="bootstrap" close-on-select="false" title="<?php echo Yii::t('regexp', '0922') ?>">
                            <ui-select-match placeholder="<?php echo Yii::t('regexp', '0922') ?>">{{$item.title}}</ui-select-match>
                            <ui-select-choices repeat="career in careers track by $index">
                                {{career.title}}
                            </ui-select-choices>
                        </ui-select>
                    </div>

                    <div class="row">
                        <label></label>
                        <?php echo $form->textField($model, 'aboutUs', array('maxlength' => 100, 'placeholder' => Yii::t('regexp', '0154'), 'id' => 'aboutUs')); ?>
                        <span><?php echo $form->error($model, 'aboutUs'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'skype'); ?>
                        <?php echo $form->textField($model, 'skype', array('maxlength' => 50, 'id' => 'skype', 'placeholder' => 'Skype')); ?>
                        <span><?php echo $form->error($model, 'skype'); ?></span>
                    </div>
                    <div class="row rowNetwork">
                        <?php echo $form->label($model, 'facebook'); ?>
                        <?php echo $form->textField($model, 'facebook', array('maxlength' => 255, 'class' => 'indicator','placeholder' => Yii::t('regexp', '0243'), 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'facebook'); ?>
                    </div>
                    <div class="row rowNetwork">
                        <?php echo $form->label($model, 'googleplus'); ?>
                        <?php echo $form->textField($model, 'googleplus', array('maxlength' => 255, 'class' => 'indicator','placeholder' => Yii::t('regexp', '0244'), 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'googleplus'); ?>
                    </div>
                    <div class="row rowNetwork">
                        <?php echo $form->label($model, 'linkedin'); ?>
                        <?php echo $form->textField($model, 'linkedin', array('maxlength' => 255, 'class' => 'indicator','placeholder' => Yii::t('regexp', '0245'), 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'linkedin'); ?>
                    </div>
<!--                    <div class="row rowNetwork">-->
<!--                        --><?php //echo $form->label($model, 'vkontakte'); ?>
<!--                        --><?php //echo $form->textField($model, 'vkontakte', array('maxlength' => 255, 'class' => 'indicator','placeholder' => Yii::t('regexp', '0246'), 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
<!--                        --><?php //echo $form->error($model, 'vkontakte'); ?>
<!--                    </div>-->
                    <div class="row rowNetwork">
                        <?php echo $form->label($model, 'twitter'); ?>
                        <?php echo $form->textField($model, 'twitter', array('maxlength' => 255, 'class' => 'indicator','placeholder' => Yii::t('regexp', '0247'), 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'twitter'); ?>
                    </div>
                </div>
                <div id="accountantTab">
                    <div class="row rowTextarea">
                        <input type="hidden" name="specializations">
                        <label><?php echo Yii::t('regexp', '0924') ?></label>
                        <ui-select multiple ng-model="dataForm.specializations" theme="bootstrap" close-on-select="false" title="<?php echo Yii::t('regexp', '0925') ?>">
                            <ui-select-match placeholder="<?php echo Yii::t('regexp', '0925') ?>" >{{$item.title}}</ui-select-match>
                            <ui-select-choices repeat="item in specializations track by $index">
                                {{item.title}}
                            </ui-select-choices>
                        </ui-select>
                    </div>

                    <div class="rowRadioButton" id="rowEducForm">
                        <?php echo $form->labelEx($model, 'educform'); ?>
                        <div class="radiolabel">
                            <input type="checkbox" name="educformOff" value="" style="display:none" checked/>

                            <label>
                                <checkbox class="g-checkbox checked" ng-model="dataForm.educformOn" name="educformOn" disabled="true"></checkbox>
                                <?php echo EducationForm::model()->findByPk(EducationForm::ONLINE)->$param ?>
                            </label>

                            <label>
                                <checkbox class="g-checkbox" ng-model="dataForm.educformOff" value="true"></checkbox>
                                <?php echo EducationForm::model()->findByPk(EducationForm::OFFLINE)->$param ?>
                            </label>
                        </div>
                    </div>
                    <div ng-show="dataForm.educformOff" class="radioShift row">
                        <?php echo $form->label($model, 'education_shift'); ?>
                        <div class="radiolabel">
                            <label>
                                <input class="checkstyle" type="radio" name="shift" value="<?php echo EducationShift::MORNING ?>"/>
                                <?php echo EducationShift::model()->findByPk(EducationShift::MORNING)->$param ?>
                            </label>
                            <label>
                                <input class="checkstyle" type="radio" name="shift" value="<?php echo EducationShift::EVENING ?>"/>
                                <?php echo EducationShift::model()->findByPk(EducationShift::EVENING)->$param ?>
                            </label>
                            <label>
                                <input class="checkstyle" type="radio" name="shift" value="<?php echo EducationShift::ALL_ONE ?>" checked="checked"/>
                                <?php echo EducationShift::model()->findByPk(EducationShift::ALL_ONE)->$param ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rowbuttons">
                <?php echo CHtml::submitButton(Yii::t('regexp', '0155'), array('id' => "submit", 'ng-disabled'=>'StudentReg.$invalid')); ?>
            </div>
            <?php if (Yii::app()->user->hasFlash('message')):
                echo Yii::app()->user->getFlash('message');
            endif; ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!-- form -->
<script>
    $(document).ready(function () {
        var today = new Date();
        var yr = today.getFullYear();
        $(".date").inputmask("dd/mm/yyyy", {
            yearrange: {minyear: 1900, maxyear: yr},
            "placeholder": "<?php echo Yii::t('regexp', '0262');?>"
        });
    });
</script>
<!-- Scripts for open tabs-->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openRegistrationTab.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openTab.js"></script>
<!-- Scripts for open tabs -->