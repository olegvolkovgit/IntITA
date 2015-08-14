<!-- studprofile style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/studProfile.css" />
<!-- studprofile style -->
<!-- uploadInfo, jQuery -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/uploadInfo.js"></script>
<!-- uploadInfo, jQuery -->
<?php
/* @var $this StudentregController */
/* @var $model studentreg */
/* @var $form CActiveForm */
?>
<?php
$this->pageTitle = 'INTITA';
$post=StudentReg::model()->findByPk(Yii::app()->user->id);
if (!isset($tab)) $tab=0;
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.date.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.phone.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/jquery.inputmask.regex.extensions.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/inputmask/mask.js"></script>
<!--StyleForm Check and radio box-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/jquery.formstyler.css" rel="stylesheet" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/jquery.formstyler.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/formstyler/inputstyler.js"></script>
<!--StyleForm Check and radio box-->
<div class="formStudProfNav">
    <?php
    $this->breadcrumbs=array(
        Yii::t('breadcrumbs', '0054')=>Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)),Yii::t('breadcrumbs', '0055')
    );
    ?>

</div>
<div class="formStudProf">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'studentreg-form',
        'action'=> Yii::app()->createUrl('studentreg/rewrite'),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <div class="studProf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php $post::getProfileRole($post->id);?></h2>
                </td>
            </tr>
        </table>
        <div class="tabs">
            <ul>
                <li>
                    <?php echo Yii::t('regexp', '0562');?>
                </li>
                <li>
                    <?php echo Yii::t('regexp', '0563');?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="mainreg">
                    <div class="row">
                        <?php echo $form->label($model,'firstName'); ?>
                        <?php echo $form->textField($model,'firstName',array('value'=>$post->firstName,'maxlength'=>20)); ?>
                        <span><?php echo $form->error($model,'firstName'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model,'secondName'); ?>
                        <?php echo $form->textField($model,'secondName',array('value'=>$post->secondName,'maxlength'=>20)); ?>
                        <span><?php echo $form->error($model,'secondName'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model,'nickname'); ?>
                        <?php echo $form->textField($model,'nickname',array('value'=>$post->nickname,'maxlength'=>20)); ?>
                        <span><?php echo $form->error($model,'nickname'); ?></span>
                    </div>
                    <div class="rowDate">
                        <?php echo $form->label($model,'birthday'); ?>
                        <?php echo $form->textField($model,'birthday',array('value'=>$post->birthday, 'class'=>'date','maxlength'=>11, 'placeholder'=>Yii::t('regexp', '0152'))); ?>
                        <span><?php echo $form->error($model,'birthday'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model,'phone'); ?>
                        <?php echo $form->textField($model,'phone',array('value'=>$post->phone,'class'=>'phone','maxlength'=>15)); ?>
                        <span><?php echo $form->error($model,'phone'); ?></span>
                    </div>
                    <?php if($post::getRole($post->id)==False){
                        ?>
                        <div class="rowRadioButton" id="rowEducForm">
                            <?php echo $form->labelEx($model,'educform'); ?>

                            <div class="radiolabel">
                                <label><input class="checkstyle" type="checkbox" name="educformOn" checked disabled/>online</label>
                                <label><input class="checkstyle" type="checkbox" name="educformOff" value="1" <?php echo $post::getEdForm($post->educform)?> />offline</label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <?php echo $form->label($model,'email'); ?>
                        <?php echo $form->textField($model,'email',array('value'=>$post->email,'maxlength'=>40,"disabled"=>"disabled" )); ?>
                        <span><?php echo $form->error($model,'email'); ?></span>
                    </div>
                    <?php if(is_null($post->password)){
                        ?>
                        <div class="rowPass">
                            <?php echo $form->label($model,'password'); ?>
                            <span class="passEye"><?php echo $form->passwordField($model,'password',array('maxlength'=>20)); ?></span>
                            <?php echo $form->error($model,'password'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->label($model,'password_repeat'); ?>
                            <span class="passEye"> <?php echo $form->passwordField($model,'password_repeat',array('maxlength'=>20)); ?></span>
                            <?php echo $form->error($model,'password_repeat'); ?>
                        </div>
                    <?php }?>
                </div>
                <div id="addreg">
                    <div class="row">
                        <?php echo $form->label($model,'address'); ?>
                        <?php echo $form->textField($model,'address',array('value'=>$post->address,'maxlength'=>100)); ?>
                        <span><?php echo $form->error($model,'address'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model,'education'); ?>
                        <?php echo $form->textField($model,'education',array('value'=>$post->education,'maxlength'=>100)); ?>
                        <span><?php echo $form->error($model,'education'); ?></span>
                    </div>

                    <div class="row">
                        <?php echo $form->label($model,'aboutMy'); ?>
                        <?php echo $form->textArea($model,'aboutMy',array('value'=>$post->aboutMy,'maxlength'=>500)); ?>
                        <?php echo $form->error($model,'aboutMy'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->label($model,'interests'); ?>
                        <?php echo $form->textField($model,'interests',array('value'=>$post->interests,'maxlength'=>255, 'placeholder'=>Yii::t('regexp', '0153'))); ?>
                        <span><?php echo $form->error($model,'interests'); ?></span>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model,'aboutUs',array('placeholder'=>Yii::t('regexp', '0154'), 'id'=>'aboutUs','maxlength'=>100)); ?>
                        <span><?php echo $form->error($model,'aboutUs'); ?></span>
                    </div>

                    <div class="rowNetwork">
                        <?php echo $form->label($model,'facebook'); ?>
                        <?php echo $form->textField($model,'facebook',array('placeholder'=>Yii::t('regexp', '0243'), 'value'=>$post::getFacebooknameProfile($post->facebook), 'maxlength'=>30,'id'=>'trimF')); ?>
                        <?php echo $form->error($model,'facebook'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model,'googleplus'); ?>
                        <?php echo $form->textField($model,'googleplus',array('placeholder'=>Yii::t('regexp', '0244'), 'value'=>$post::getGooglenameProfile($post->googleplus), 'maxlength'=>30,'id'=>'trimG')); ?>
                        <?php echo $form->error($model,'googleplus'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model,'linkedin'); ?>
                        <?php echo $form->textField($model,'linkedin',array('placeholder'=>Yii::t('regexp', '0245'), 'value'=>$post::getLinkedinId($post->linkedin), 'maxlength'=>30,'id'=>'trimL')); ?>
                        <?php echo $form->error($model,'linkedin'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model,'vkontakte'); ?>
                        <?php echo $form->textField($model,'vkontakte',array('placeholder'=>Yii::t('regexp', '0246'), 'value'=>$post::getVkId($post->vkontakte), 'maxlength'=>30,'id'=>'trimV')); ?>
                        <?php echo $form->error($model,'vkontakte'); ?>
                    </div>
                    <div class="rowNetwork">
                        <?php echo $form->label($model,'twitter'); ?>
                        <?php echo $form->textField($model,'twitter',array('placeholder'=>Yii::t('regexp', '0247'), 'value'=>$post::getTwitternameProfile($post->twitter), 'maxlength'=>30,'id'=>'trimT')); ?>
                        <?php echo $form->error($model,'twitter'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!is_null($post->password)){
         echo CHtml::link(Yii::t('regexp', '0248'), '#', array('id'=>'changepassword', 'onclick' => '$("#changePasswordDialog").dialog("open"); return false;'));
        }
            ?>
        <?php echo CHtml::link(Yii::t('regexp', '0295'), '#', array('id'=>'changepassword','onclick' => '$("#changeemail").dialog("open"); return false;')); ?>
        <div class="rowbuttons">
            <?php echo CHtml::submitButton(Yii::t('regexp', '0249'), array('id' => "submitEdit", 'onclick' => 'trimNetwork()')); ?>
        </div>
        <?php if(Yii::app()->user->hasFlash('message')):
            echo Yii::app()->user->getFlash('message');
        endif; ?>
    </div>
    <div class="studPhoto">
        <table class="titleProfileAv">
            <tr>
                <td>
                    <h2><?php echo Yii::t('regexp', '0156');?></h2>
                </td>
            </tr>
        </table>
        <img class='avatarimg' src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar);?>"/>
        <?php if($post->avatar!=='noname.png') {
        ?>
            <div>
            <a href="<?php echo Yii::app()->createUrl('studentreg/deleteavatar');?>">
                <?php echo Yii::t('regexp', '0561');?>
            </a>
            </div>
        <?php
        }
        ?>
        <div class="fileform">
            <input class="avatar" type="button" value="<?php echo Yii::t('regexp', '0157');?>">
            <input tabindex="-1" type="file" name="upload" class="chooseAvatar" onchange="getName(this.value);" accept="image/jpeg">
            <input tabindex="-1" class="uploadAvatar" type="submit">
        </div>
        <div id="avatarHelp"><?php echo Yii::t('regexp', '0158');?></div>
        <div id="avatarInfo"><?php echo Yii::t('regexp', '0159');?></div>
        <div class="avatarError">
            <?php if(Yii::app()->user->hasFlash('avatarmessage')):
                echo Yii::app()->user->getFlash('avatarmessage');
            endif; ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
</div>
<!--Change modal-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'changePasswordDialog',
    'themeUrl'=>Yii::app()->request->baseUrl.'/css',
    'cssFile'=>'jquery-ui.css',
    'theme'=>'my',
    'options' => array(
        'width'=>540,
        'autoOpen' => false,
        'modal' => true,
        'resizable'=> false
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
    'themeUrl'=>Yii::app()->request->baseUrl.'/css',
    'cssFile'=>'jquery-ui.css',
    'theme'=>'my',
    'options' => array(
        'width'=>540,
        'autoOpen' => false,
        'modal' => true,
        'resizable'=> false
    ),
));
$this->renderPartial('_changeemail');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--Change email modal-->
<script>
$(document).ready(function(){
    var today = new Date();
    var yr = today.getFullYear();
    $(".date").inputmask("dd/mm/yyyy", {yearrange: { minyear: 1900, maxyear: yr-3 }, "placeholder": "<?php echo Yii::t('regexp', '0262');?>"}); //specify year range
});
<!-- Script for open tabs-->
$(document).ready(function(){
    $(".tabs").lightTabs(<?php echo $tab?>);
});
</script>
<!-- OpenTab-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/openTab.js"></script>
<!-- OpenTab -->
