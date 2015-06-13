<?php $order = Lecture::model()->count("idModule=$newmodel->module_ID and `order`>0"); ?>
<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveLesson');?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('module', '0382'); ?></span>
    <br>
    <span><?php echo Yii::t('module', '0226')." ".($newmodel->lesson_count + 1)."."; ?></span>
    <input name="idModule" value="<?php echo $newmodel->module_ID;?>" hidden="hidden">
    <input name="order" value="<?php echo $order+1;?>" hidden="hidden">
    <input name="lang" value="<?php echo $newmodel->language;?>" hidden="hidden">
    <input type="text" name="newLectureName" id="newLectureName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі.,;: ()/+-]+$">
    <br><br>
    <input type="submit"  value=<?php echo Yii::t('module', '0383'); ?> id="submitButton" onclick="trimLectureName()">
</form>
<button id="cancelButton" onclick="hideForm('lessonForm', 'newLectureName');"><?php echo Yii::t('module', '0384'); ?></button>
<div style="margin-top: 75px">
    <?php if(Yii::app()->user->hasFlash('newLecture')):
        echo Yii::app()->user->getFlash('newLecture');
    endif; ?>
</div>
