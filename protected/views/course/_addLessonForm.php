<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveModule');?>" method="post">
    <br>
    <span id="formLabel">Новий модуль:</span>
    <br>
    <span><?php echo "Модуль ".($newmodel->modules_count + 1)."."; ?></span>
    <input name="idCourse" value="<?php echo $newmodel->course_ID;?>" hidden="hidden">
    <input name="order" value="<?php echo ($newmodel->modules_count + 1);?>" hidden="hidden">
    <input name="lang" value="<?php echo $newmodel->language;?>" hidden="hidden">
    <input type="text" name="newModuleName" id="newModuleName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9ЄєІі.,:;`'?!~* ()/+-]+$">
    <br><br>
    <input type="submit"  value="Додати" id="submitButton">
</form>
<button id="cancelButton" onclick="hideForm('moduleForm', 'newModuleName')">Скасувати</button>