<?php
/**
 * @var $model Module
 */
?>
<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name='addLesson' action="<?php echo Yii::app()->createUrl('revision/createNewLecture'); ?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('module', '0382'); ?></span>
<!--    <span>--><?php //echo Yii::t('module', '0226') . " " . ($model->lecturesCount() + 1) . "."; ?><!--</span>-->
    <input name="idModule" value="<?php echo $model->module_ID; ?>" type="hidden">
<!--    <input name="order" value="--><?php //echo ($model->lecturesCount() + 1); ?><!--" type="hidden">-->
    <div>Назва (UA)*:</div>
    <input class="form-control" type="text" name="titleUa" id="titleUa" required ng-model="titleUa"
           pattern="^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="70"
           oninvalid="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')" >
    <div>Назва (RU):</div>
    <input class="form-control" type="text" name="titleRu" id="titleRu" pattern="^[=а-яА-ЯёЁa-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255"
           size="70" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <div>Назва (EN):</div>
    <input class="form-control" type="text" name="titleEn" id="titleEn" pattern="^[=a-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="70"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <input type="submit" value=<?php echo Yii::t('module', '0383'); ?> id="submitButton" onclick="trimLectureName()" ng-disabled=addLesson.$invalid >
</form>
<button id="cancelButton"
        onclick="hideForm('lessonForm');" ><?php echo Yii::t('module', '0384'); ?></button>
