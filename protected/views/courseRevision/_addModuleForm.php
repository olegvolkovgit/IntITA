<?php
/* @var $model Course */
?>
<form id="addLessonForm" onsubmit="$('#submitButton').attr('disabled','true');" name="addModule">
    <br>
    <div>Назва (UA)*</div>
    <input class="form-control" type="text" name="titleUA" id="titleUA" required ng-model="titleUa"
           pattern="<?php echo Yii::app()->params['titleUAPattern'] ?>+$" maxlength="255" size="60"
           oninvalid="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0684'); ?>')">
    <div>Назва (RU)</div>
    <input class="form-control" type="text" name="titleRU" id="titleRU" ng-model="titleRu" pattern="<?php echo Yii::app()->params['titleRUPattern'] ?>+$" maxlength="255"
           size="60" oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <div>Назва (EN)</div>
    <input class="form-control" type="text" name="titleEN" id="titleEN" ng-model="titleEn" pattern="<?php echo Yii::app()->params['titleENPattern'] ?>+$" maxlength="255" size="60"
           oninput="validateComments(this,'<?php echo Yii::t('validation', '0685'); ?>')">
    <div class="form-group success">
        <label class="required">Мова <span class="required">*</span></label>
        <select class="form-control" ng-init="language = languages[0]"
                ng-model="language"
                ng-options="language.name for language in languages">
        </select>
    </div>
    <label>Додайте до модуля теги, котрі відповідають його категорії</label>
    <div class="tagCloud">
        <ul class="select-search-list">
            <li ng-repeat="tag in tags track by $index">
                <span ng-click="addTag(tag,$index)">{{tag.tag}}<span class="close select-search-list-item_selection-remove">+</span></span>
            </li>
        </ul>
    </div>
    <label>Категорії модуля:</label>
    <div class="tagCloud">
        <ul class="select-search-list">
            <li ng-repeat="moduleTag in moduleTags track by $index">
                <span ng-click="removeTag(moduleTag,$index)">{{moduleTag.tag}}<span class="close select-search-list-item_selection-remove">×</span>
            </li>
        </ul>
    </div>

    <br>
    <input type="checkbox" name="isAuthor" ng-model='isAuthor' value="<?=Yii::app()->user->getId();?>"> редагувати модуль
    <br>
    <br>
    <input  class="btn btn-info" type="submit" value="<?php echo Yii::t('course', '0367') ?>" id="submitButton" ng-click="createModule()" ng-disabled=addModule.$invalid>
    <button type='button' class="btn btn-default" id="cancelButton" ng-click="hideForm('moduleForm', 'titleUA', 'titleRU', 'titleEN')"><?php echo Yii::t('course', '0368') ?></button>
</form>