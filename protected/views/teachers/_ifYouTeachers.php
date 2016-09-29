<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 17:06
 */
?>
<div class="ifYouTeachers" id="xex">
    <table>
        <tr>
            <td valign="top"><img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'teacher123.png');?>"/></td>
            <td valign="center"><div id="formTeacher3"><?php echo Yii::t('teachers', '0060');?></div></td>
            <td valign="top">
                <div id="xex" onclick='xexx()' style="cursor: pointer;">
                    <img
                        src="<?php echo StaticFilesHelper::createPath('image', 'common', 'close_button.png');?>">
                </div>
            </td>
        </tr>
    </table>
    <?php $form=$this->beginWidget('CActiveForm',array(
        'id'=>'teacherletter-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>false,
        ),
        'htmlOptions'=> array(
            'method'=>'post',
            'name'=>'letter',
            'ng-controller'=>'sendTeacherLetter',
            'novalidate'=>true
        )
    )); ?>
        <div class="row">
            <?=$form->label($teacherletter,'firstname')?><span>*</span>
            <?=$form->textField($teacherletter,'firstname',array('ng-model'=>"firstname", 'ng-pattern'=>'/^[a-zа-яіїёєЄA-ZА-ЯІЇЁ\s\'’]+$/u',"required"=>true))?>
            <div ng-cloak  class="clientValidationError" ng-show="letter['TeacherLetter[firstname]'].$dirty && letter['TeacherLetter[firstname]'].$invalid">
                <span ng-show="letter['TeacherLetter[firstname]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                <span ng-show="letter['TeacherLetter[firstname]'].$error.pattern"><?php echo Yii::t('error','0429') ?></span>
            </div>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'lastname')?><span>*</span>
            <?=$form->textField($teacherletter,'lastname',array('ng-model'=>"lastname", 'ng-pattern'=>'/^[a-zа-яіїёєЄA-ZА-ЯІЇЁ\s\'’]+$/u',"required"=>true))?>
            <div ng-cloak  class="clientValidationError" ng-show="letter['TeacherLetter[lastname]'].$dirty && letter['TeacherLetter[lastname]'].$invalid">
                <span ng-show="letter['TeacherLetter[lastname]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                <span ng-show="letter['TeacherLetter[lastname]'].$error.pattern"><?php echo Yii::t('error','0429') ?></span>
            </div>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'age')?>
            <?=$form->numberField($teacherletter,'age',array('class'=>'letterAge','ng-model'=>"age",
                "ng-min"=>"16", "ng-max"=>"100",'min'=>16,'max'=>100))?>
            <div ng-cloak  class="clientValidationError" ng-show="letter['TeacherLetter[age]'].$invalid">
                <span ng-show="letter['TeacherLetter[age]'].$invalid"><?php echo Yii::t('validation','0913') ?></span>
            </div>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'education')?>
            <?=$form->textField($teacherletter,'education')?>
            <?=$form->error($teacherletter,'education')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'phone')?><span>*</span>
            <?=$form->textField($teacherletter,'phone',array('maxlength'=>13, 'class'=>'letterPhone','ng-model'=>"phone",'ng-pattern'=>'/^[0-9\+\-\(\)\s]+$/u',"required"=>true))?>
            <div ng-cloak  class="clientValidationError" ng-show="letter['TeacherLetter[phone]'].$dirty && letter['TeacherLetter[phone]'].$invalid">
                <span ng-show="letter['TeacherLetter[phone]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                <span ng-show="letter['TeacherLetter[phone]'].$error.pattern"><?php echo Yii::t('error','0429') ?></span>
            </div>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'email')?><span>*</span>
            <?=$form->emailField($teacherletter,'email',array('class'=>'letterEmail','ng-model'=>"email","required"=>true))?>
            <div ng-cloak class="clientValidationError" ng-show="letter['TeacherLetter[email]'].$dirty && letter['TeacherLetter[email]'].$invalid">
                <span ng-show="letter['TeacherLetter[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                <span ng-show="letter['TeacherLetter[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
                <span ng-show="letter['TeacherLetter[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
            </div>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'courses',array('class'=>'courseslabel'))?><span>*</span>
            <?=$form->textArea($teacherletter,'courses', array("required"=>true,'ng-model'=>"courses"))?>
            <div ng-cloak class="clientValidationError" ng-show="letter['TeacherLetter[courses]'].$dirty && letter['TeacherLetter[courses]'].$invalid">
                <span ng-show="letter['TeacherLetter[courses]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
            </div>
        </div>
    <ul class="actions">
        <input id='send_btn' type="button" name='sendletter' ng-click="sendLetter()" value="<?php echo Yii::t('teachers', '0180') ?>" ng-disabled=letter.$invalid>
    </ul>
    <?php $this->endWidget(); ?>
    <div id='letterFlash' style="margin-top: 75px">
        <?php if(Yii::app()->user->hasFlash('messagemail')):
            echo Yii::app()->user->getFlash('messagemail');
        endif; ?>
    </div>
</div>
