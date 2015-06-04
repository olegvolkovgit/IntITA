<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveLesson');?>" method="post">
    <br>
    <span id="formLabel">Нове заняття:</span>
    <br>
    <span><?php echo Yii::t('module', '0226')." ".($newmodel->lesson_count + 1)."."; ?></span>
    <input name="idModule" value="<?php echo $newmodel->module_ID;?>" hidden="hidden">
    <input name="order" value="<?php echo ($newmodel->lesson_count + 1);?>" hidden="hidden">
    <input name="lang" value="<?php echo $newmodel->language;?>" hidden="hidden">
    <input type="text" name="newLectureName" id="newLectureName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі., ()/+-]+$">
    <br><br>
    <input type="submit"  value="Додати" id="submitButton">
</form>
<button id="cancelButton" onclick="hideForm('lessonForm', 'newLectureName');">Скасувати</button>
<div style="margin-top: 75px">
    <?php if(Yii::app()->user->hasFlash('newLecture')):
        echo Yii::app()->user->getFlash('newLecture');
    endif; ?>
</div>
