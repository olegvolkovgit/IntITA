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
        'action'=>array("teachers/teacherletter"),
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>false,
        ),
        'htmlOptions'=> array(
            'method'=>'post',
        )
    )); ?>
        <div class="row">
            <?=$form->label($teacherletter,'firstname')?>
            <?=$form->textField($teacherletter,'firstname')?>
            <?=$form->error($teacherletter,'firstname')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'lastname')?>
            <?=$form->textField($teacherletter,'lastname')?>
            <?=$form->error($teacherletter,'lastname')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'age')?>
            <?=$form->textField($teacherletter,'age',array('class'=>'letterAge'))?>
            <?=$form->error($teacherletter,'age')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'education')?>
            <?=$form->textField($teacherletter,'education')?>
            <?=$form->error($teacherletter,'education')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'phone')?>
            <?=$form->textField($teacherletter,'phone',array('maxlength'=>13, 'class'=>'letterPhone'))?>
            <?=$form->error($teacherletter,'phone')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'email')?>
            <?=$form->textField($teacherletter,'email',array('class'=>'letterEmail'))?>
            <?=$form->error($teacherletter,'email')?>
        </div>
        <div class="row">
            <?=$form->label($teacherletter,'courses',array('class'=>'courseslabel'))?>
            <?=$form->textArea($teacherletter,'courses')?>
            <?=$form->error($teacherletter,'courses')?>
        </div>
    <ul class="actions">
        <?=CHtml::submitButton(Yii::t('teachers', '0180'),array('id'=>'send_btn', 'name'=>'sendletter', 'onclick' => 'trimLetterEmail()'))?>
    </ul>
    <?php $this->endWidget(); ?>
    <div style="margin-top: 75px">
        <?php if(Yii::app()->user->hasFlash('messagemail')):
            echo Yii::app()->user->getFlash('messagemail');
        endif; ?>
    </div>
</div>
