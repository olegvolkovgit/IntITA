<div id="editPlainTask">
    <br>
    <form  name="plainTask" method="post" action="<?php echo Yii::app()->createUrl('plainTask/editTask');?>">
        <fieldset>
            <label><?php echo Yii::t('lecture','0774'); ?></label>
            <br>
            <textarea name="block_element" class="plainTaskCondition" placeholder="<?php echo Yii::t('lecture','0773');  ?>" required ><?php echo $data['html_block'] ?></textarea>
            <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
            <input name="lectureId" id="lectureId" type="hidden" value="<?php echo $data->id_lecture;?>"/>
            <input name="testType" id="testType" type="hidden" value="plain"/>
            <input name="id_block" id="testType" type="hidden" value="<?php echo $data->id_block ?>"/>
            <input name="author" id="author" type="hidden" value="<?php echo TeacherHelper::getTeacherId(Yii::app()->user->getId());?>"/>
            <br>
            <input type="submit" value=<?php echo Yii::t('lecture','0720'); ?> id='addtests'>



    </form>
    <form onsubmit="confirm('Ви впевнені, що хочете видалити задачу?')" name="unablePlainTask" method="post" action="<?php echo Yii::app()->createUrl('plainTask/unablePlainTask');?>" >
        <input type="submit" value="<?php echo Yii::t('lecture','0718'); ?>">
        <input name="pageId" id="pageId" type="hidden" value="<?php echo $pageId;?>"/>
    </form>
    </fieldset>

</div>
