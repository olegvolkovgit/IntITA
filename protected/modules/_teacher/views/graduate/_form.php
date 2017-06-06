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
            <input type="text" size="135" ng-model="user"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Користувач" uib-typeahead="item as item.fullName for item in getAllUsersByOrganization($viewValue) | limitTo : 10"
                   typeahead-no-results="noResults" class="form-control" />
            <div ng-if="noResults"><button>Додати користувача</button></div>
            <pre>{{user}}</pre>
        </div>
        <div class="form-group">
            <label>
                <strong>E-mail:</strong>
            </label>
            <input type="text" class="form-control" ng-model="user.email" ng-required="true"   />
        </div>
            <div class="form-group">
                <label>
                    <strong>Аватар</strong>
                </label>
                <div>Select an image file: <input type="file" id="fileInput" /></div>
                <div class="cropArea">
                    <img-crop image="myImage" result-image="graduate.user.avatar"></img-crop>
                </div>
                <div>Cropped Image:</div>
                <div><img ng-src='/images/avatars/{{graduate.user.avatar}}' /></div>
            </div>
        <div class="form-group">
            <label>
                <strong>Дата випуску:</strong>
            </label>
                <input type="text" class="form-control" ng-model="graduate.date_done" ng-required="true"/>
        </div>
        <div class="form-group">
            <label>
                <strong>Посада:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.position">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Місце роботи:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.workplace">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Посилання на місце роботи</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.workplaceUrl">
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
                   size="90" required ng-model="graduate.rate">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Відгук:</strong>
            </label>

            <textarea id="comment" type="text" class="form-control" name="comment"
                      size="90" required ng-model="graduate.comment"></textarea>
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Ім'я англійською *</strong>
            </label>
            <input id="nameEn" type="text" class="form-control" name="nameEn"
                   size="90" required ng-model="graduate.nameEn">
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
                       size="90" required ng-model="graduate.surnameEn">
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
                       size="90" required ng-model="graduate.nameRu">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="graduate.surnameRu">
                <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit">Створити</button>
        </div>
    </form>><!-- form -->
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