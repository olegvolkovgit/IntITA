<?php/* @var $form CActiveForm */?>

<div id="addPlainTask">
    <br>

    <?php $form = $this->beginWidget('CActiveForm'); ?>
    <?php $model = new PlainTask(); ?>

    <div >
        <?php echo $form->label($model,'block_element'); ?>
        <div class="plainTaskCondition"><?php echo $form->textArea($model,'block_element') ?></div>
    </div>


    <div class="row submit">
        <?php echo CHtml::submitButton('Войти'); ?>
    </div>

    <?php $this->endWidget(); ?>
<!--    <form  name="plainTask" method="post" action="--><?php //echo Yii::app()->createUrl('plainTask/addTask');?><!--">-->
<!--        <fieldset>-->
<!--           <input type="area" name="condition">-->
<!---->
<!---->
<!--            <input name="optionsNum" id="optionsNum" type="hidden" value="1"/>-->
<!--            <input name="pageId" id="pageId" type="hidden" value="--><?php //echo $pageId;?><!--"/>-->
<!--            <input name="lectureId" id="lectureId" type="hidden" value="--><?php //echo $lecture;?><!--"/>-->
<!--            <input name="testType" id="testType" type="hidden" value="plain"/>-->
<!--            <input name="author" id="author" type="hidden" value="--><?php //echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?><!--"/>-->
<!--        </fieldset>-->
<!--        <input type="submit" value="Додати тест" id='addtests'>-->
<!--    </form>-->
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>
