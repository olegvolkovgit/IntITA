<?php
/* @var $pageId integer */
?>
<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="addSkipTask">
        <fieldset>
            <legend id="label"><?=Yii::t('editor', '0788');?></legend>
            <label for="skipTaskCondition"><?=Yii::t('editor', '0790');?></label>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsTask" name="condition" id="skipTaskCondition" cols="105" rows="10"
                      required ng-model="addSkipTaskCond"></textarea>
            <br>
            <label for="questionId"><?=Yii::t('editor', '0791');?></label>
            <br>
            <textarea ng-cloak ckeditor="editorOptionsSkipTask" name="question" id="questionId" cols="105" rows="5"
                      ng-model="addSkipTaskQuest"></textarea>
            <br>
        </fieldset>
        <input type="submit" ng-click="createSkipTaskCKE('<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>',
         <?php echo $pageId;?>, <?=Yii::app()->user->getId();?>)"
               ng-disabled="addSkipTask.$invalid" value="<?=Yii::t('editor', '0789');?>">
    </form>
    <br>
    <button onclick='cancelSkipTask()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

