<?php
/* @var $model Course */
?>
<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name="addModule" action="<?php echo Yii::app()->createUrl('module/saveModule'); ?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('course', '0365') ?></span>
    <br>
    <input name="idCourse" value="<?php echo $model->course_ID; ?>" type="hidden">
    <input name="lang" value="<?php echo $model->language; ?>" type="hidden">
    <div>Назва (UA)*</div>
    <input class="form-control" type="text" name="titleUA" id="titleUA" required ng-model="titleUa"
           pattern="<?php echo Yii::app()->params['titleUAPattern'] ?>+$" maxlength="255" size="60"
           oninvalid="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')">
    <div>Назва (RU)</div>
    <input class="form-control" type="text" name="titleRU" id="titleRU" pattern="<?php echo Yii::app()->params['titleRUPattern'] ?>+$" maxlength="255"
           size="60" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <div>Назва (EN)</div>
    <input class="form-control" type="text" name="titleEN" id="titleEN" pattern="<?php echo Yii::app()->params['titleENPattern'] ?>+$" maxlength="255" size="60"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <input type="checkbox" name="isAuthor" value="<?=Yii::app()->user->getId();?>"> редагувати модуль
    <br>
    <br>
    <input type="submit" value="<?php echo Yii::t('course', '0367') ?>" id="submitButton" onclick="trimModuleName()" ng-disabled=addModule.$invalid>
</form>
<button id="cancelButton"
        onclick="hideForm('moduleForm', 'titleUA', 'titleRU', 'titleEN')"><?php echo Yii::t('course', '0368') ?></button>