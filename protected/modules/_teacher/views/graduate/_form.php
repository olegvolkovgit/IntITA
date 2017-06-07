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
            <input type="text" size="135" ng-model="graduate.user"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Оберіть користувача" uib-typeahead="item as item.fullName for item in getAllUsersByOrganization($viewValue) | limitTo : 10"
                   typeahead-no-results="noResults" class="form-control"
                   typeahead-on-select="selectedUser($item, $model, $label, $event)"/>
            <div ng-if="noResults"><button class="btn btn-primary"
                                           ng-bootbox-title="Додати нового користувача"
                                           ng-bootbox-custom-dialog
                                           ng-bootbox-custom-dialog-template="/angular/js/teacher/templates/addUserTemplate.html"
                                           >
                    Додати користувача
                </button></div>
            <pre>{{graduate}}</pre>
        </div>
        <div class="form-group">
            <label>
                <strong>Фото:</strong>
            </label>
            <div><img ng-src='/images/avatars/{{graduate.user.avatar}}' /></div>
        </div>

        <div class="form-group">
            <label>
                <strong>Дата випуску:</strong>
            </label>
            <p class="input-group col-md-3">
                <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="graduate.date_done"
                       is-open="open" datepicker-options="dateOptions" ng-required="true" close-text="Закрити"
                       alt-input-formats="altInputFormats"/>
                <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="openDatepicker()"><i
                        class="glyphicon glyphicon-calendar"></i></button>
          </span>   </p>
        </div>
        <div class="form-group">
            <label>
                <strong>Посада:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.position">

        </div>

        <div class="form-group">
            <label>
                <strong>Місце роботи:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.work_place">
            <div class="error" ng-show="errors.ChatPhrases_text && form.user.$touched">{{errors.ChatPhrases_text[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Посилання на місце роботи</strong>
            </label>
            <input id="position" type="url" class="form-control" name="userPosition"
                   size="90" required ng-model="graduate.work_site">

        </div>

        <div class="form-group">
            <label>
                <strong>Курс:</strong>
            </label>
            <input type="text" size="135" ng-model="graduate.course"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Оберіть курс" uib-typeahead="item as item.title_ua for item in getAllCoursesByOrganization($viewValue) | limitTo : 10"
                   typeahead-no-results="noResults" class="form-control" />
            <div ng-if="noResults"><span>Курс не знайдено</span></div>

        </div>
        <div class="form-group">
            <label>
                <strong>Рейтинг:</strong>
            </label>
            <input id="rate" type="text" class="form-control" name="rate"
                   size="90" required ng-model="graduate.rate">

        </div>

        <div class="form-group">
            <label>
                <strong>Відгук:</strong>
            </label>

            <textarea id="comment" type="text" class="form-control" name="comment"
                      size="90" required ng-model="graduate.recall"></textarea>

        </div>

        <div class="form-group">
            <label>
                <strong>Ім'я англійською *</strong>
            </label>
            <input id="nameEn" type="text" class="form-control" name="nameEn"
                   size="90" required ng-model="graduate.first_name_en">
            <div class="error" ng-show="errors.first_name_en">{{errors.first_name_en[0]}}</div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище англійською *</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="graduate.last_name_en">
                <div class="error" ng-show="errors.last_name_en">{{errors.last_name_en[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Ім'я російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" ng-model="graduate.first_name_ru">
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" ng-model="graduate.last_name_ru">
            </div>
        </div>

        <div class="form-group">
            <button type="submit">Створити</button>
        </div>
    </form><!-- form -->
</div>