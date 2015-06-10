<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveModule');?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('course', '0365') ?></span>
    <br>
    <span><?php echo Yii::t('course', '0366')." ".($newmodel->modules_count + 1)."."; ?></span>
    <input name="idCourse" value="<?php echo $newmodel->course_ID;?>" hidden="hidden">
    <input name="order" value="<?php echo ($newmodel->modules_count + 1);?>" hidden="hidden">
    <input name="lang" value="<?php echo $newmodel->language;?>" hidden="hidden">
    <input type="text" name="newModuleName" id="newModuleName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі.,:;`'?!~* ()/+-]+$" maxlength="255">
    <br><br>
    <input type="submit"  value="<?php echo Yii::t('course', '0367') ?>" id="submitButton">
</form>
<button id="cancelButton" onclick="hideForm('moduleForm', 'newModuleName')"><?php echo Yii::t('course', '0368') ?></button>