<!-- studprofile style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/studProfile.css"/>
<!-- studprofile style -->
<!-- uploadInfo, jQuery -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/uploadInfo.js"></script>
<!-- uploadInfo, jQuery -->
<?php
/* @var $this StudentRegController */
/* @var $model StudentReg */
/* @var $regExtended Regextended */
/* @var $form CActiveForm */
$this->pageTitle = 'INTITA';
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0056'),
);
?>
<!--Role-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/rolesReg.js"></script>
<!--Role-->
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.date.extensions.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.numeric.extensions.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.custom.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/mask.js"></script>
<!--StyleForm Check and radio box-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/jquery.formstyler.css" rel="stylesheet"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/jquery.formstyler.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/inputstyler.js"></script>
<!--StyleForm Check and radio box-->
<div class="formStudProf">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'registration-form',
        'action' => array('studentreg/registration'),
//        'enableClientValidation'=>true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false,
            'afterValidate' => 'js:function(){if($("div").is(".rowNetwork.error")) $(".tabs").lightTabs("1"); else if($("div").is(".error")){ $(".tabs").lightTabs("0");} return true;}',),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <?php
    if (!isset($email)) $email = $_POST['StudentReg']['email'];
    ?>
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
                <li>
                    <?php echo Yii::t('regexp', '0563'); ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="mainreg">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'firstName'); ?>
                        <?php echo $form->textField($model, 'firstName', array('maxlength' => 20, 'autofocus' => 'true')); ?>
                        <span><?php echo $form->error($model, 'firstName'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'secondName'); ?>
                        <?php echo $form->textField($model, 'secondName', array('maxlength' => 20)); ?>
                        <span><?php echo $form->error($model, 'secondName'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'nickname'); ?>
                        <?php echo $form->textField($model, 'nickname', array('maxlength' => 20)); ?>
                        <span><?php echo $form->error($model, 'nickname'); ?></span>
                    </div>
                    <div class="rowDate">
                        <?php echo $form->label($model, 'birthday'); ?>
                        <?php echo $form->textField($model, 'birthday', array('maxlength' => 11, 'class' => 'date', 'placeholder' => Yii::t('regexp', '0152'))); ?>
                        <span><?php echo $form->error($model, 'birthday'); ?></span>
                    </div>
                    <div class="rowPhone">
                        <?php echo $form->labelEx($model, 'phone'); ?>
                        <div class="user_phone">
                            <?php echo $form->textField($model, 'phone', array('class' => 'phone', 'maxlength' => 15)); ?>
                        </div>
                        <span><?php echo $form->error($model, 'phone'); ?></span>
                    </div>
                    <div class="rowRadioButton" id="rowEducForm">
                        <?php echo $form->labelEx($model, 'educform'); ?>
                        <div class="radiolabel">
                            <label><input class="checkstyle" type="checkbox" name="educformOn" checked disabled/>online</label>
                            <label><input class="checkstyle" type="checkbox" name="educformOff"
                                          value="1"/>offline</label>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <?php echo $form->textField($model, 'email', array('value' => $email, 'class' => 'trimEm', 'maxlength' => 40)); ?>
                        <span><?php echo $form->error($model, 'email'); ?></span>
                    </div>
                    <div class="rowPass">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <span
                            class="passEye"><?php echo $form->passwordField($model, 'password', array('maxlength' => 20)); ?></span>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password_repeat'); ?>
                        <span
                            class="passEye"> <?php echo $form->passwordField($model, 'password_repeat', array('maxlength' => 20)); ?></span>
                        <?php echo $form->error($model, 'password_repeat'); ?>
                    </div>
                </div>
                <div id="addreg">
                    <div class="row">
                        <?php echo $form->label($model, 'address'); ?>
                        <?php echo $form->textField($model, 'address', array('maxlength' => 100)); ?>
                        <span><?php echo $form->error($model, 'address'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'education'); ?>
                        <?php echo $form->textField($model, 'education', array('maxlength' => 100)); ?>
                        <span><?php echo $form->error($model, 'education'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'aboutMy'); ?>
                        <?php echo $form->textArea($model, 'aboutMy', array('maxlength' => 500)); ?>
                        <?php echo $form->error($model, 'aboutMy'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model, 'interests'); ?>
                        <?php echo $form->textField($model, 'interests', array('maxlength' => 255, 'placeholder' => Yii::t('regexp', '0153'))); ?>
                        <span><?php echo $form->error($model, 'interests'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model, 'aboutUs', array('maxlength' => 100, 'placeholder' => Yii::t('regexp', '0154'), 'id' => 'aboutUs')); ?>
                        <span><?php echo $form->error($model, 'aboutUs'); ?></span>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'facebook'); ?>
                        <?php echo CHtml::textField('', '', array('placeholder' => Yii::t('regexp', '0243'), 'maxlength' => 255, 'id' => 'tempFBLink')); ?>
                        <?php echo $form->hiddenField($model, 'facebook'); ?>
                        <span><?php echo $form->error($model, 'facebook'); ?></span>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'googleplus'); ?>
                        <?php echo CHtml::textField('', '', array('placeholder' => Yii::t('regexp', '0244'), 'maxlength' => 255, 'id' => 'tempGPLink')); ?>
                        <?php echo $form->hiddenField($model, 'googleplus'); ?>
                        <?php echo $form->error($model, 'googleplus'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'linkedin'); ?>
                        <?php echo CHtml::textField('', '', array('placeholder' => Yii::t('regexp', '0245'), 'maxlength' => 255, 'id' => 'tempLILink')); ?>
                        <?php echo $form->hiddenField($model, 'linkedin'); ?>
                        <?php echo $form->error($model, 'linkedin'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'vkontakte'); ?>
                        <?php echo CHtml::textField('', '', array('placeholder' => Yii::t('regexp', '0246'), 'maxlength' => 255, 'id' => 'tempVKLink')); ?>
                        <?php echo $form->hiddenField($model, 'vkontakte'); ?>
                        <?php echo $form->error($model, 'vkontakte'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model, 'twitter'); ?>
                        <?php echo CHtml::textField('', '', array('placeholder' => Yii::t('regexp', '0247'), 'maxlength' => 255, 'id' => 'tempTWLink')); ?>
                        <?php echo $form->hiddenField($model, 'twitter'); ?>
                        <?php echo $form->error($model, 'twitter'); ?>
                    </div>
                </div>
            </div>
            <div class="rowbuttons">
                <?php echo CHtml::submitButton(Yii::t('regexp', '0155'), array('id' => "submit", 'onclick' => 'trimExpEmail()')); ?>
            </div>
            <?php if (Yii::app()->user->hasFlash('message')):
                echo Yii::app()->user->getFlash('message');
            endif; ?>
        </div>
    </div>
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
                 src="<?php echo StaticFilesHelper::createPath('image', 'avatars', 'noname.png'); ?>"/>

            <div class="fileform">
                <input class="avatar" type="button" value="<?php echo Yii::t('regexp', '0157'); ?>">
                <?php echo CHtml::activeFileField($model, 'avatar', array('tabindex' => '-1', "class" => "chooseAvatar", "onchange" => "getName(this.value)")); ?>
                <input tabindex="-1" class="uploadAvatar" type="submit">
            </div>
            <div id="avatarHelp"><?php echo Yii::t('regexp', '0158'); ?></div>
            <div id="avatarInfo"><?php echo Yii::t('regexp', '0159'); ?></div>
            <div class="avatarError">
                <?php echo $form->error($model, 'avatar'); ?>
            </div>
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
            yearrange: {minyear: 1900, maxyear: yr - 3},
            "placeholder": "<?php echo Yii::t('regexp', '0262');?>"
        }); //specify year range
    });
    <!-- Script for open tabs-->
    $(document).ready(function () {
        $(".tabs").lightTabs(0);
    });
</script>
<!-- OpenTab-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/openTab.js"></script>
<!-- OpenTab -->