<?php
/* @var $this GraduateController */
/* @var $model Graduate */
/* @var $form CActiveForm */
?>
<div class="formMargin" ng-controller="graduateCtrl">
        <form id="graduateForm" ng-submit="addGraduate()" novalidate>

        <div class="form-group">
            <label>
                <strong>Користувач:</strong>
            </label>
            <input type="text" size="135" ng-model="newGraduate.user"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Користувач" uib-typeahead="item.email for item in getAllUsersByOrganization($viewValue) | limitTo : 10"
                   typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                   typeahead-on-select="onSelectTrainer($item)" ng-change="reloadTrainer()" class="form-control" />
        </div>

        <div class="form-group">
            <label>
                <strong>Аватар:</strong>
            </label>
            <div class="errorMessage" style="display: none"></div>
        </div>
        <div class="form-group">
            <input id="date_done" type="text" class="form-control" name="user" placeholder="Введіть фразу"
                   size="90" required ng-model="newGraduate.date_done">
            <div class="error" ng-show="errors.Graduate && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            <div ng-cloak  class="errorMessage" ng-show="Graduate['Graduate[date_done]'].$invalid">
                <span ng-show="Graduate['Graduate[date_done]'].$error.pattern"><?php echo Yii::t('graduate','0749') ?></span>
            </div>

        </div>
        <div class="form-group">
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="newGraduate.position">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Місце роботи:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="newGraduate.position">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Посилання на місце роботи</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="newGraduate.position">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Курс:</strong>
            </label>
        </div>
        <div class="form-group">
            <label>
                <strong>Рейтинг:</strong>
            </label>
            <input id="rate" type="text" class="form-control" name="rate"
                   size="90" required ng-model="newGraduate.rate">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Відгук:</strong>
            </label>

            <textarea id="comment" type="text" class="form-control" name="comment"
                      size="90" required ng-model="newGraduate.comment"></textarea>
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Ім'я англійською *</strong>
            </label>
            <input id="nameEn" type="text" class="form-control" name="nameEn"
                   size="90" required ng-model="newGraduate.nameEn">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            <a href="#"
               onclick="translateName('<?= $model->isNewRecord ? "" : $model->first_name; ?>', '#Graduate_first_name_en', '#Graduate_first_name'); return false;">
                Згенерувати автоматично</a>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище англійською *</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="newGraduate.position">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
                <a href="#"
                   onclick="translateName('<?= $model->isNewRecord ? "" : $model->first_name; ?>', '#Graduate_first_name_en', '#Graduate_first_name'); return false;">
                    Згенерувати автоматично</a>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Ім'я російською *</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="newGraduate.position">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="newGraduate.position">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit">Створити</button>
        </div>
    </div><!-- form -->
</form>
</div>

<script>
    $jq(document).ready(function () {
        $jq("#Graduate_graduate_date").datepicker(lang);
    });
    function translateName(source, id, sourceId) {
        if(!source) source = $jq(sourceId).val();
        $jq(id).val(toEnglish(source));
    }
</script>