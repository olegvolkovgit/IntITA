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
            <?=$form->labelEx($teacherletter,'firstname',array('class'=>'formFirstname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'firstname')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'firstname')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'lastname',array('class'=>'formLastname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'lastname')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'lastname')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'age',array('class'=>'formYearname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'age')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'age')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'education',array('class'=>'formEducationname','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'education')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'education')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'phone',array('class'=>'formPhonename','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'phone')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'phone')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'email',array('class'=>'formEmail','id'=>'formTeacher'))?>
            <?=$form->textField($teacherletter,'email')?>
<!--            <br>-->
            <?=$form->error($teacherletter,'email')?>
        </div>
        <br><br>
        <div class="row">
            <?=$form->labelEx($teacherletter,'courses',array('class'=>'formTextname','id'=>'formTeacher'))?>
            <?=$form->textArea($teacherletter,'courses',array('class'=>'formTeacher1','id'=>'formTeacher2'))?>
            <br><br><br>
            <?=$form->error($teacherletter,'courses')?>
        </div>
        <br><br>
        <ul class="actions">
            <?=CHtml::submitButton(Yii::t('teachers', '0180'),array('id'=>'send_btn', 'name'=>'sendletter'))?>
        </ul>
    </form>
    <div style="margin-top: 75px">
        <?php if(Yii::app()->user->hasFlash('messagemail')):
            echo Yii::app()->user->getFlash('messagemail');
        endif; ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        var today = new Date();
        var yr = today.getFullYear();
        $("#bdate").inputmask("dd/mm/yyyy", {yearrange: { minyear: 1900, maxyear: yr-3 }, "placeholder": "<?php echo Yii::t('regexp', '0262');?>"}); //specify year range
    });
</script>
