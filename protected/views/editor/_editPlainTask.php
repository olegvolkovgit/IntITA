<div id="editPlainTask">
    <br>
    <form  name="plainTask" method="post" action="<?php echo Yii::app()->createUrl('plainTask/editTask');?>">
        <fieldset>
            <textarea name="block_element" class="plainTaskCondition" ><?php echo $quiz->html_block ?></textarea>

            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="author" id="author" type="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
        </fieldset>

        <button ><?php echo Yii::t('lecture','0718'); ?></button>
        <input type="submit" value=<?php echo Yii::t('lecture','0720'); ?> id='addtests'>

    </form>

    <button onclick='cancelTest()'><?php echo Yii::t('lecture', '0707'); ?></button>

</div>
