<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/studProfile.css"/>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/uploadInfo.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-select/select.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-select/select.min.css'); ?>"/>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/bootstrap.min.css'); ?>">
<?php
/* @var $this StudentregController */
/* @var $model Studentreg
 * @var $post StudentReg
/* @var $form CActiveForm */
$user = RegisteredUser::userById(Yii::app()->user->id);
$post = $user->registrationData;
$post->firstName = addslashes($post->firstName);
$post->secondName = addslashes($post->secondName);
$param = "title_".Yii::app()->session["lg"];
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.extensions.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.phone.extensions.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.numeric.extensions.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/jquery.inputmask.regex.extensions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'inputmask/mask.js'); ?>"></script>
<!--StyleForm Check and radio box-->
<link href="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/jquery.formstyler.css'); ?>" rel="stylesheet"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/jquery.formstyler.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formstyler/inputstyler.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select.min.css'); ?>" rel="stylesheet"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/countryCityServices.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/specializationsServices.js'); ?>"></script>
<script>
    basePath = '<?php echo Config::getBaseUrl(); ?>';
    avatar= '<?php echo $post->avatar ?>';
</script>
<!--StyleForm Check and radio box-->
<div class="formStudProfNav">
    <?php
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0054') => Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)), Yii::t('breadcrumbs', '0055')
    );
    ?>

</div>
<div class="formStudProf" ng-cloak>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'editProfile-form',
        'action' => Yii::app()->createUrl('studentreg/rewrite'),
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,
            'afterValidate' => 'js:function(){if($("div").is(".rowNetwork.error")) $(".tabs").lightTabs("1"); else if($("div").is(".error")){ $(".tabs").lightTabs("0");} return true;}',),
        'htmlOptions' => array('enctype' => 'multipart/form-data', 'ng-controller' => "editProfileController", 'name' => 'profileForm', 'novalidate' => true),
    )); ?>
    <div class="rightProfileColumn">
        <div class="studPhoto">
            <table class="titleProfileAv">
                <tr>
                    <td>
                        <h2><?php echo Yii::t('regexp', '0156'); ?></h2>
                    </td>
                </tr>
            </table>
            <img class='avatarimg'
                 src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar); ?>"/>
            <?php if ($post->avatar !== 'noname.png') {
                ?>
                <div>
                    <a href="<?php echo Yii::app()->createUrl('studentreg/deleteavatar'); ?>">
                        <?php echo Yii::t('regexp', '0561'); ?>
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="fileform">
                <?php echo CHtml::activeFileField($model, 'avatar', array('tabindex' => '-1', "id" => "chooseAvatar", 'max-file-size' => "5242880", 'ng-model' => "attachment", 'file-check' => "", "onchange" => "getName(this.value)")); ?>
                <label id="avatar" for="chooseAvatar"><?php echo Yii::t('regexp', '0157'); ?></label>
            </div>
            <div id="avatarHelp"><?php echo Yii::t('regexp', '0158'); ?></div>
            <div id="avatarInfo"><?php echo Yii::t('regexp', '0159'); ?></div>
            <div ng-cloak class="clientValidationError"
                 ng-show="profileForm['StudentReg[avatar]'].$error.size || profileForm['StudentReg[avatar]'].$error.fileType">
                <div
                    ng-show="profileForm['StudentReg[avatar]'].$error.size"><?php echo Yii::t('error', '0302'); ?></div>
                <div
                    ng-show="profileForm['StudentReg[avatar]'].$error.fileType"><?php echo Yii::t('error', '0672'); ?></div>
            </div>
            <div class="avatarError">
                <?php echo $form->error($model, 'avatar'); ?>
            </div>
            <div id="progressBar">
                <div id="profileIndicator"><?php echo Yii::t('edit', '0618') . ' '; ?><span id="percent"></span>%</div>
                <div id="indicators">
                    <img id='progressLine'
                         src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'progressline0.png'); ?>'>
                    <img id='progressMask'
                         src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'progressline1.png'); ?>'>
                </div>
                <div id="twoCrowns">
                    <img src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'crown.png'); ?>'>
                </div>
                <div>
                    <table id="emptyFieldList">
                        <tr ng-repeat="model in modelsArr track by $index" ng-hide="{{model.name}} || (model.name=='selectedCity' && !selectedCountry)">
                            <td><img src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'plus.png');?>' ng-click='focusEmptyField(model.name)'></td>
                            <td><?php echo Yii::t('edit', '0620');?> {{model.msg}}</td>
                        </tr>
                        <tr ng-hide="avatar!='noname.png'">
                            <td><img src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'plus.png');?>' ng-click='focusAvatar()'></td>
                            <td><?php echo Yii::t('edit', '0619');?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="gridBlock">
            <div id="gridProgress">
                <img id='fullGrid'
                     src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'progressgrid1.png'); ?>'>
                <img id='gridMask'
                     src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'progressgrid.png'); ?>'>
            </div>
            <div id="crowns">
                <img src='<?php echo StaticFilesHelper::createPath('image', 'icons', 'crowns.png'); ?>'>
            </div>
        </div>
    </div>
    <div class="studProf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php $post->getProfileRole(); ?></h2>
                </td>
            </tr>
        </table>
        <div class="tabs">
            <ul>
                <li>
                    <?php echo Yii::t('regexp', '0562').' Персональні дані'; ?>
                </li>
                <li>
                    <?php echo Yii::t('regexp', '0563').' Познайомимось ближче'; ?>
                </li>
                <li>
                    <?php echo 'Укладення договору' ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="mainreg">
                    <div class="row">
                        <?php echo $form->label($model, 'firstName'); ?>
                        <?php echo $form->textField($model, 'firstName', array('ng-init' => "dataForm.firstName='$post->firstName'", 'maxlength' => 20, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0621'), 'ng-model' => "dataForm.firstName", 'ng-pattern' => '/^[a-zа-яіїёA-ZА-ЯІЇЁєЄ\s\'’]+$/', 'placeholder' => Yii::t('regexp', '0160'))); ?>
                        <span><?php echo $form->error($model, 'firstName'); ?></span>
                        <div ng-cloak class="clientValidationError"
                             ng-show="profileForm['StudentReg[firstName]'].$invalid">
                            <span
                                ng-show="profileForm['StudentReg[firstName]'].$error.pattern"><?php echo Yii::t('error', '0416') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'secondName'); ?>
                        <?php echo $form->textField($model, 'secondName', array('ng-init' => "dataForm.secondName='$post->secondName'", 'maxlength' => 20, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0622'), 'ng-model' => "dataForm.secondName", 'ng-pattern' => '/^[a-zа-яіїёA-ZА-ЯІЇЁєЄ\s\'’]+$/', 'placeholder' => Yii::t('regexp', '0162'))); ?>
                        <span><?php echo $form->error($model, 'secondName'); ?></span>

                        <div ng-cloak class="clientValidationError"
                             ng-show="profileForm['StudentReg[secondName]'].$invalid">
                            <span
                                ng-show="profileForm['StudentReg[secondName]'].$error.pattern"><?php echo Yii::t('error', '0416') ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'nickname'); ?>
                        <?php echo $form->textField($model, 'nickname', array('ng-init' => "dataForm.nickname='$post->nickname'", 'maxlength' => 20, 'class' => 'indicator', 'ng-model' => "dataForm.nickname", 'data-source' => Yii::t('edit', '0623'), 'placeholder' => Yii::t('regexp', '0163'))); ?>
                        <span><?php echo $form->error($model, 'nickname'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'birthday'); ?>
                        <?php echo $form->textField($model, 'birthday', array('ng-init' => "dataForm.birthday='$post->birthday'",'ng-keyup'=>"modelWatch('dataForm.birthday')", 'ng-model' => "dataForm.birthday", 'class' => 'date indicator', 'maxlength' => 11, 'placeholder' => Yii::t('regexp', '0152'), 'data-source' => Yii::t('edit', '0624'))); ?>
                        <span><?php echo $form->error($model, 'birthday'); ?></span>
                    </div>
                    <div class="row selectRow">
                        <?php echo $form->label($model, 'country'); ?>
                        <div class="selectBox">
                            <oi-select
                                oi-options="country.title for country in countriesList track by country.id"
                                ng-model="selectedCountry"
                                single
                                oi-select-options="{cleanModel: true}"
                                placeholder="<?php echo Yii::t('regexp', '0896'); ?>"
                                class="indicator"
                                data-source='<?php echo Yii::t('regexp', '0897'); ?>'
                                id="countrySelect"
                            ></oi-select>
                        </div>
                        <span><?php echo $form->error($model, 'country'); ?></span>
                        <?php echo $form->hiddenField($model, 'country'); ?>
                    </div>
                    <div ng-show="selectedCountry" class="row selectRow">
                        <?php echo $form->label($model, 'city'); ?>
                        <div class="selectBox">
                            <oi-select
                                oi-options="city.title for city in citiesList track by city.id"
                                ng-model="selectedCity"
                                single
                                oi-select-options="{
                                cleanModel: true,
                                newItem: 'prompt',
                                newItemModel: {id: null, title: $query},
                                maxlength:50
                                }"
                                placeholder="<?php echo Yii::t('regexp', '0898'); ?>"
                                class="indicator"
                                data-source='<?php echo Yii::t('regexp', '0899'); ?>'
                                id="citySelect"
                            ></oi-select>
                        </div>
                        <input type="hidden" name="cityTitle">
                        <span><?php echo $form->error($model, 'city'); ?></span>
                        <?php echo $form->hiddenField($model, 'city'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'address'); ?>
                        <?php echo $form->textField($model, 'address', array('ng-init' => "dataForm.address='$post->address'", 'ng-model' => "dataForm.address", 'maxlength' => 100, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0626'), 'placeholder' => Yii::t('regexp', '0166'))); ?>
                        <span><?php echo $form->error($model, 'address'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'phone'); ?>
                        <?php echo $form->textField($model, 'phone', array('ng-init' => "dataForm.phone='$post->phone'",'ng-keyup'=>"modelWatch('dataForm.phone')",'model-watch'=>'phone', 'ng-model' => "dataForm.phone", 'class' => 'phone indicator', 'maxlength' => 15, 'minlength' => 15, 'data-source' => Yii::t('edit', '0625'), 'placeholder' => Yii::t('regexp', '0165'))); ?>
                        <span><?php echo $form->error($model, 'phone'); ?></span>
                    </div>
                    <div ng-cloak class="clientValidationError" ng-show="profileForm['StudentReg[phone]'].$invalid">
                            <span ng-show="profileForm['StudentReg[phone]'].$error.min"><?php echo Yii::t('error', '0416') ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'email'); ?>
                        <?php echo $form->textField($model, 'email', array('ng-init' => "dataForm.email='$post->email'", 'ng-model' => "dataForm.email", 'maxlength' => 40, "disabled" => "disabled", 'class' => 'indicator')); ?>
                        <span><?php echo $form->error($model, 'email'); ?></span>
                    </div>
                    <?php if (is_null($post->password)) {
                        ?>
                        <div class="rowPass">
                            <?php echo $form->label($model, 'password'); ?>
                            <span
                                class="passEye"><?php echo $form->passwordField($model, 'password', array('maxlength' => 20, 'ng-model' => "pw1")); ?></span>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->label($model, 'password_repeat'); ?>
                            <span
                                class="passEye"> <?php echo $form->passwordField($model, 'password_repeat', array('maxlength' => 20, 'ng-model' => "pw2", 'pw-check' => "pw1")); ?></span>
                            <?php echo $form->error($model, 'password_repeat'); ?>
                            <div ng-cloak class="clientValidationError"
                                 ng-show="profileForm['StudentReg[password_repeat]'].$dirty && profileForm['StudentReg[password_repeat]'].$invalid">
                                <span
                                    ng-show="profileForm['StudentReg[password_repeat]'].$error.pwmatch"><?php echo Yii::t('error', '0269') ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="addreg">
                    <div class="row rowAbout rowTextarea">
                        <?php echo $form->label($model, 'aboutMy'); ?>
                        <?php echo $form->textArea($model, 'aboutMy', array('ng-init' => "dataForm.aboutMy='$post->aboutMy'", 'ng-model' => "dataForm.aboutMy", 'maxlength' => 500, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0628'), 'placeholder' => Yii::t('regexp', '0170'))); ?>
                        <?php echo $form->error($model, 'aboutMy'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'interests'); ?>
                        <?php echo $form->textField($model, 'interests', array('ng-init' => "dataForm.interests='$post->interests'", 'ng-model' => "dataForm.interests", 'maxlength' => 255, 'placeholder' => Yii::t('regexp', '0153'), 'class' => 'indicator', 'data-source' => Yii::t('edit', '0629'))); ?>
                        <span><?php echo $form->error($model, 'interests'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'education'); ?>
                        <?php echo $form->textField($model, 'education', array('ng-init' => "dataForm.education='$post->education'", 'ng-model' => "dataForm.education", 'maxlength' => 100, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0627'), 'placeholder' => Yii::t('regexp', '0167'))); ?>
                        <span><?php echo $form->error($model, 'education'); ?></span>
                    </div>
                    <div class="row">
                        <label></label>
                        <?php echo $form->textField($model, 'aboutUs', array('ng-init' => "dataForm.aboutUs='$post->aboutUs'", 'ng-model' => "dataForm.aboutUs", 'placeholder' => Yii::t('regexp', '0154'), 'id' => 'aboutUs', 'maxlength' => 100, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0630'))); ?>
                        <span><?php echo $form->error($model, 'aboutUs'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'skype'); ?>
                        <?php echo $form->textField($model, 'skype', array('ng-init' => "dataForm.skype='$post->skype'", 'ng-model' => "dataForm.skype", 'maxlength' => 50, 'class' => 'indicator', 'data-source' => 'Skype', 'placeholder' => 'Skype')); ?>
                        <span><?php echo $form->error($model, 'skype'); ?></span>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'facebook'); ?>
                        <?php echo $form->textField($model, 'facebook', array('ng-init' => "dataForm.facebook='$post->facebook'", 'ng-model' => "dataForm.facebook", 'maxlength' => 255, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0631'), 'placeholder' => Yii::t('regexp', '0243'), 'onKeyUp' => "hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'facebook'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'googleplus'); ?>
                        <?php echo $form->textField($model, 'googleplus', array('ng-init' => "dataForm.googleplus='$post->googleplus'", 'ng-model' => "dataForm.googleplus", 'maxlength' => 255, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0632'), 'placeholder' => Yii::t('regexp', '0244'), 'onKeyUp' => "hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'googleplus'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'linkedin'); ?>
                        <?php echo $form->textField($model, 'linkedin', array('ng-init' => "dataForm.linkedin='$post->linkedin'", 'ng-model' => "dataForm.linkedin", 'maxlength' => 255, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0633'), 'placeholder' => Yii::t('regexp', '0245'), 'onKeyUp' => "hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'linkedin'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'vkontakte'); ?>
                        <?php echo $form->textField($model, 'vkontakte', array('ng-init' => "dataForm.vkontakte='$post->vkontakte'", 'ng-model' => "dataForm.vkontakte", 'maxlength' => 255, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0634'), 'placeholder' => Yii::t('regexp', '0246'), 'onKeyUp' => "hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'vkontakte'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'twitter'); ?>
                        <?php echo $form->textField($model, 'twitter', array('ng-init' => "dataForm.twitter='$post->twitter'", 'ng-model' => "dataForm.twitter", 'maxlength' => 255, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0635'), 'placeholder' => Yii::t('regexp', '0247'), 'onKeyUp' => "hideServerValidationMes(this)")); ?>
                        <?php echo $form->error($model, 'twitter'); ?>
                    </div>
                </div>
                <div id="accountantTab">
                    <div class="row rowTextarea">
                        <label>Спеціалізація</label>
                        <ui-select multiple ng-model="dataForm.ggg" theme="bootstrap" close-on-select="false" title="Обери спеціалізацію">
                            <ui-select-match placeholder="Обери спреціалізацію, яка тебе цікавить">{{$item.specialization}}</ui-select-match>
                            <ui-select-choices repeat="spec in specializations track by $index">
                                {{spec.specialization}}
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <div class="rowRadioButton" id="rowEducForm">
                        <?php echo $form->labelEx($model, 'educform'); ?>
                        <div class="radiolabel">
                            <label>
                                <input class="checkstyle" type="checkbox" name="educformOn" checked disabled/>
                                <?php echo EducationForm::model()->findByPk(EducationForm::ONLINE)->$param ?>
                            </label>
                            <label>
                                <input class="checkstyle" type="checkbox" name="educformOff" value="3" <?php echo $post::getEdForm($post->educform) ?> />
                                <?php echo EducationForm::model()->findByPk(EducationForm::OFFLINE)->$param ?>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'education'); ?>
                        <?php echo $form->textField($model, 'education', array('ng-init' => "dataForm.education='$post->education'", 'ng-model' => "dataForm.education", 'maxlength' => 100, 'class' => 'indicator', 'data-source' => Yii::t('edit', '0627'), 'placeholder' => Yii::t('regexp', '0167'))); ?>
                        <span><?php echo $form->error($model, 'education'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="rowbuttons">
            <?php if (!is_null($post->password)) {
                echo CHtml::link(Yii::t('regexp', '0248'), '#', array('id' => 'changepassword', 'onclick' => '$("#changePasswordDialog").dialog("open"); return false;'));
            }
            ?>
            <?php echo CHtml::link(Yii::t('regexp', '0295'), '#', array('id' => 'changepassword', 'onclick' => '$("#changeemail").dialog("open"); return false;')); ?>
            <?php echo CHtml::submitButton(Yii::t('regexp', '0249'), array('id' => "submitEdit", 'onclick' => 'trimNetwork()', 'ng-disabled' => 'profileForm.$invalid')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<!--Change modal-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'changePasswordDialog',
    'themeUrl' => Yii::app()->request->baseUrl . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false
    ),
));
$this->renderPartial('/studentreg/_changepassword');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--Change modal-->
<!--Change email modal-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'changeemail',
    'themeUrl' => Yii::app()->request->baseUrl . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false
    ),
));
$this->renderPartial('_changeemail');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--Change email modal-->
<script>
    $(document).ready(function () {
        var today = new Date();
        var yr = today.getFullYear();
        $(".date").inputmask("dd/mm/yyyy", {
            yearrange: {minyear: 1900, maxyear: yr - 3},
            "placeholder": "<?php echo Yii::t('regexp', '0262');?>"
        }); //specify year range
    });
</script>
<!-- Scripts for open tabs-->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openEditTab.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openTab.js"></script>
<!-- Scripts for open tabs-->