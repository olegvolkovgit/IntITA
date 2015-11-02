<?php $order = Lecture::model()->count("idModule=$newmodel->module_ID and `order`>0"); ?>
<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveLesson');?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('module', '0382'); ?></span>
    <span><?php echo Yii::t('module', '0226')." ".($newmodel->lesson_count + 1)."."; ?></span>
    <input name="idModule" value="<?php echo $newmodel->module_ID;?>" type="hidden">
    <input name="order" value="<?php echo $order+1;?>" type="hidden">
    <br>
    <br>
    <span>Назва (UA):</span>
    <input type="text" name="titleUa" id="titleUa" required pattern="^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="70" oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')">
    <br>
    <br>
    <span>Назва (RU):</span>
    <input type="text" name="titleRu" id="titleRu" pattern="^[=а-яА-ЯёЁa-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="70" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <br>
    <span>Назва (EN):</span>
    <input type="text" name="titleEn" id="titleEn" pattern="^[=a-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="70" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br><br>
    <input type="submit"  value=<?php echo Yii::t('module', '0383'); ?> id="submitButton" onclick="trimLectureName()">
</form>
<button id="cancelButton" onclick="hideForm('lessonForm', 'titleUa', 'titleRu', 'titleEn');"><?php echo Yii::t('module', '0384'); ?></button>
<div style="margin-top: 75px">
    <?php if(Yii::app()->user->hasFlash('newLecture')):
        echo Yii::app()->user->getFlash('newLecture');
    endif; ?>
</div>
