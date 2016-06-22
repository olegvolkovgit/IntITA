<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name='addLesson' action="<?php echo Yii::app()->createUrl('revision/createNewLecture'); ?>" method="post">
    <br>
    <input name="idModule" value="<?php echo $idModule; ?>" type="hidden">
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
    <input type="submit" class="btn btn-default" value=<?php echo Yii::t('module', '0383'); ?> onclick="trimLectureName()" ng-disabled=addLesson.$invalid >
</form>
<br>
