<div id="editPlainTask">
    <br>
    <form  name="plainTask" method="post" action="<?php echo Yii::app()->createUrl('plainTask/editTask');?>">
        <fieldset>
            <textarea name="block_element" class="plainTaskCondition" ><?php echo $data['html_block'] ?></textarea>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $data->id_lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="id_block" id="testType" type="hidden" value="<?php echo $data->id_block ?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
            <br>
            <button onclick='unablePlainTask(<?php echo $pageId ?>)' > <?php echo Yii::t('lecture','0718'); ?></button>
            <input type="submit" value=<?php echo Yii::t('lecture','0720'); ?> id='addtests'>

        </fieldset>


    </form>


</div>
