<?php
/* @var $model Course */
$order = $model->modulesCount(); ?>
<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name="addRevisionModule" action="<?php echo Yii::app()->createUrl('moduleRevision/createNewModuleRevision'); ?>" method="post">
    <input name="idCourse" value="<?php echo $model->course_ID; ?>" type="hidden">
    <input name="order" value="<?php echo $order + 1 ?>" type="hidden">
    <input name="lang" value="<?php echo $model->language; ?>" type="hidden">
    <div>Назва (UA)*</div>
    <input class="form-control" type="text" name="revTitleUa" id="revTitleUA" required ng-model="revTitleUA"
           pattern="^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60"
           oninvalid="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')">
    <div>Назва (RU)</div>
    <input class="form-control" type="text" name="revTitleRu" id="revTitleRU" pattern="^[=а-яА-ЯёЁa-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255"
           size="60" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <div>Назва (EN)</div>
    <input class="form-control" type="text" name="revTitleEn" id="revTitleEN" pattern="^[=a-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <br>
    <input type="submit" value="<?php echo Yii::t('course', '0367') ?>" id="submitButton" onclick="trimModuleName()" ng-disabled=addRevisionModule.$invalid>
</form>
<button id="cancelButton"
        onclick="hideForm('moduleRevisionForm', 'revTitleUA', 'revTitleRU', 'revTitleEN')"><?php echo Yii::t('course', '0368') ?></button>