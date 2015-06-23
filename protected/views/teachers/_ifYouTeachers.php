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
            <td valign="top"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher123.png"/></td>
            <td valign="center"><div id="formTeacher3"><?php echo Yii::t('teachers', '0060');?></div></td>
            <td valign="top">
                <div id="xex" onclick='xexx()' style="cursor: pointer;">
                    <img
                        src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/close_button.png">
                </div>
            </td>
        </tr>
    </table>
    <!--form method="post" action="<?php echo Yii::app()->createUrl('teachers/teacherletter');?>">
        <label class="formFirstname" id="formTeacher" for="firstname"><?php echo Yii::t('teachers', '0174');?></label>
        <input class="formTeacher1" required type="text" name="firstname">
        <br>  <br>
        <label class="formLastname" id="formTeacher" for="lastname"><?php echo Yii::t('teachers', '0175');?></label>
        <input class="formTeacher1" required type="text" name="lastname">
        <br> <br>
        <label class="formYearname" id="formTeacher" for="yearname"><?php echo Yii::t('teachers', '0176');?></label>
        <input class="formTeacher1" required type="text" name="yearname">
        <br> <br>
        <label class="formEducationname" id="formTeacher" for="educationname"><?php echo Yii::t('teachers', '0177');?></label>
        <input class="formTeacher1" required type="text" name="educationname">
        <br> <br>
        <label class="formPhonename" id="formTeacher" for="phonename"><?php echo Yii::t('teachers', '0178');?></label>
        <input class="formTeacher1" required type="text" name="phonename">
        <br> <br>
        <label class="formEmail" id="formTeacher" for="email"><?php echo Yii::t('teachers', '0418');?></label>
        <input class="formTeacher1" id="phone" required type="email" name="email">
        <br> <br>
        <label class="formTextname" id="formTeacher" for="textname" style="width: 110px; text-align:left"><?php echo Yii::t('teachers', '0179');?></label>
        <textarea class="formTeacher1" id="formTeacher2" required type="text" name="textname"></textarea>
        <br> <br>
        <ul class="actions">
            <input id="send_btn" name="sendletter" type="submit" value="<?php echo Yii::t('teachers', '0180');?>" />
        </ul>
    </form-->
    <?php $form=$this->beginWidget('CActiveForm',array(
        'action'=>array("teachers/teacherletter"),
        /*'enableClientValidation' => true,
        'enableAjaxValidation'=>true, */
        'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
        'htmlOptions'=> array(
            'method'=>'post',
        )
    )); ?>
        <div class="row">
            <?=$form->labelEx($teacherletter,'firstname',array('class'=>'formFirstname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'firstname')?>
            <br>
            <?=$form->error($teacherletter,'firstname')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'lastname',array('class'=>'formLastname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'lastname')?>
            <br>
            <?=$form->error($teacherletter,'lastname')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'age',array('class'=>'formYearname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'age')?>
            <br>
            <?=$form->error($teacherletter,'age')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'education',array('class'=>'formEducationname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'education')?>
            <br>
            <?=$form->error($teacherletter,'education')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'phone',array('class'=>'formPhonename','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'phone')?>
            <br>
            <?=$form->error($teacherletter,'phone')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'email',array('class'=>'formEmail','id'=>'formTeacher'))?>
            <?=$form->emailField($teacherletter,'email')?>
            <br>
            <?=$form->error($teacherletter,'email')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'courses',array('class'=>'formTextname','id'=>'formTeacher'))?>
            <?=$form->textArea($teacherletter,'courses',array('class'=>'formTeacher1','id'=>'formTeacher2'))?>
            <br><br><br>
            <?=$form->error($teacherletter,'courses')?"Обов'язкове поле":""?>
        </div>
        <br><br>
        <ul class="actions">
            <?=CHtml::submitButton(Yii::t('teachers', '0180'),array('id'=>'send_btn', 'name'=>'sendletter'))?>
        </ul>
    <?php $this->endWidget(); ?>
    <div style="margin-top: 75px">
        <?php if(Yii::app()->user->hasFlash('messagemail')):
            echo Yii::app()->user->getFlash('messagemail');
        endif; ?>
    </div>
</div>
