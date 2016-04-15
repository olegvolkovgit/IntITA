<?php
/**
 * @var $form CActiveForm
 * @var $pageId integer
 * @var $lecture integer
 */
?>
<div id="addPlainTask">
    <br>
    <form  name="plainTask" method="post" action="<?php echo Yii::app()->createUrl('plainTask/addTask');?>">
        <fieldset>
            <label><?php echo Yii::t('lecture','0774'); ?></label>
            <br>
           <textarea name="block_element" id="plainTask" class="plainTaskCondition" placeholder="<?php echo Yii::t('lecture','0773'); ?>" required ng-model="addTaskPlain"></textarea>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="author" id="author" type="hidden" value="<?=Yii::app()->user->getId();?>"/>
            <br>
            <input type="submit" value="<?=Yii::t('editor', '0787');?>" id='addtests' ng-disabled=plainTask.block_element.$error.required>
        </fieldset>
    </form>
    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>
