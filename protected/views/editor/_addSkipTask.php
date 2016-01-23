<?php
/* @var $pageId integer*/
?>
<a name="taskForm"></a>
<div id="addSkipTask">
    <form name="add-skip-task">
        <fieldset>
            <legend id="label"><?=Yii::t('editor', '0788');?></legend>
            <?=Yii::t('editor', '0790');?>
            <br>
            <textarea name="condition" id="skipTaskCondition" cols="105" form="add-skip-task" rows="10" required></textarea>
            <br>
            <?=Yii::t('editor', '0791');?>
            <br>
            <textarea name="question" id="question" cols="105" form="add-skip-task" rows="5"></textarea>
            <br>
        </fieldset>
    </form>
    <br>
    <button onclick="createSkipTask('<?php echo Yii::app()->createUrl('skipTask/addTask'); ?>', <?php echo $pageId;?>)">
        <?=Yii::t('editor', '0789');?></button>
    <button onclick='cancelSkipTask()'><?php echo Yii::t('lecture', '0707'); ?></button>
</div>

