<?php
/* @var $model Course */
$order = $model->modulesCount(); ?>
<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name="addModule" action="<?php echo Yii::app()->createUrl('module/saveModule'); ?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('course', '0365') ?></span>
    <br>
    <span><?php echo Yii::t('course', '0366') . " " . ($order + 1) . ". "; ?></span>
    <br>
    <input name="idCourse" value="<?php echo $model->course_ID; ?>" type="hidden">
    <input name="order" value="<?php echo $order + 1 ?>" type="hidden">
    <input name="lang" value="<?php echo $model->language; ?>" type="hidden">
    <span>Назва (UA)*</span>
    <input type="text" name="titleUA" id="titleUA" required ng-model="titleUa"
           pattern="^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60"
           oninvalid="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')">
    <br>
    <span>Назва (RU)</span>
    <input type="text" name="titleRU" id="titleRU" pattern="^[=а-яА-ЯёЁa-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255"
           size="60" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <span>Назва (EN)</span>
    <input type="text" name="titleEN" id="titleEN" pattern="^[=a-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <input type="submit" value="<?php echo Yii::t('course', '0367') ?>" id="submitButton" onclick="trimModuleName()" ng-disabled=addModule.$invalid>
</form>
<button id="cancelButton"
        onclick="hideForm('moduleForm', 'titleUA', 'titleRU', 'titleEN')"><?php echo Yii::t('course', '0368') ?></button>