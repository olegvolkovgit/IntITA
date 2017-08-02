<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<div class="row" ng-controller="graduateCtrl">
    <div class="col col-lg-9">
        <ul class="list-inline">
            <li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('graduate')">
                    Список випускників</button>
            </li>
        </ul>
        <div class="formMargin">
                <div class="form-group">
                    <label>
                        <strong>Прізвище:</strong>
                    </label>
                    <input id="position" type="text" class="form-control" name="position"
                           size="90" required ng-model="graduate.user.secondName">
                    <div class="error" ng-show="errors.position">{{errors.position[0]}}</div>
                </div>
                <div class="form-group">
                    <label>
                        <strong>Ім'я:</strong>
                    </label>
                    <input id="position" type="text" class="form-control" name="position"
                           size="90" required ng-model="graduate.user.firstName">
                    <div class="error" ng-show="errors.position">{{errors.position[0]}}</div>
                </div>
                <div class="form-group">
                    <label>
                        <strong>По-батькові:</strong>
                    </label>
                    <input id="position" type="text" class="form-control" name="position"
                           size="90" required ng-model="graduate.user.lastName">
                    <div class="error" ng-show="errors.position">{{errors.position[0]}}</div>
                </div>
                <div class="form-group">
                    <label>
                        <strong>Фото:</strong>
                    </label>
                    <div><img ng-src='/images/avatars/{{graduate.user.avatar}}' /></div>
                </div>

                <div class="form-group">
                    <label>
                        <strong>Дата випуску*:</strong>
                    </label>
                    <p class="input-group col-md-3">
                        <input type="text" class="form-control" uib-datepicker-popup="dd-MM-yyyy" ng-model="graduate.graduate_date"
                               is-open="open" datepicker-options="dateOptions" ng-required="true" close-text="Закрити"
                               />
                        <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="openDatepicker()"><i
                        class="glyphicon glyphicon-calendar"></i></button>
          </span>   </p>
                    <div class="error" ng-show="errors.date_done">{{errors.date_done[0]}}</div>
                </div>
                <div class="form-group">
                    <label>
                        <strong>Посада:</strong>
                    </label>
                    <input id="position" type="text" class="form-control" name="position"
                           size="90" required ng-model="graduate.position">
                    <div class="error" ng-show="errors.position">{{errors.position[0]}}</div>
                </div>

                <div class="form-group">
                    <label>
                        <strong>Місце роботи:</strong>
                    </label>
                    <input id="position" type="text" class="form-control" name="work_place"
                           size="90" required ng-model="graduate.work_place">
                    <div class="error" ng-show="errors.work_place">{{errors.work_place[0]}}</div>
                </div>

                <div class="form-group">
                    <label>
                        <strong>Посилання на місце роботи</strong>
                    </label>
                    <input id="position" type="url" class="form-control" name="work_site"
                           size="90" required ng-model="graduate.work_site">
                    <div class="error" ng-show="errors.work_site">{{errors.work_site[0]}}</div>
                </div>
                <div class="form-group">
                <a href="javascript:void(0)" ng-click="courseCollapsed = !courseCollapsed">Курси</a>
                </div>
                <div uib-collapse="courseCollapsed">
                    <div class="form-group" ng-repeat="studentCourses in graduate.courses">
                        <span>
                            <strong>{{studentCourses.idCourse.title_ua}}, рейтинг: {{studentCourses.rating * graduate.ratingScale}} </strong>
                            <button class="btn btn-primary" ng-click="changeRating('course')">Змінити рейтинг</button>
                            <button class="btn btn-danger" ng-click="deleteRating('course', studentCourses.id)">Видалити курс</button>
                        </span>
                    </div>
                    <button class="btn btn-success" ng-click="addRating('course')">Додати курс</button>
                </div>
                <div class="form-group">
                <a href="javascript:void(0)" ng-click="modulesCollapsed = !modulesCollapsed">Модулі</a>
                </div>
                <div uib-collapse="modulesCollapsed">
                    <div class="form-group" ng-repeat="studentModules in graduate.modules">
                        <span><strong>{{studentModules.idModule.title_ua}}, рейтинг: {{studentModules.rating * graduate.ratingScale}} </strong> </span>
                        <button class="btn btn-primary" ng-click="changeRating('module',studentModules )">Змінити рейтинг</button>
                        <button class="btn btn-danger" ng-click="deleteRating('module',studentModules.id)">Видалити модуль</button>
                    </div>
                    <button class="btn btn-success" ng-click="addRating('module')">Додати модуль</button>

                </div>
                <div class="form-group">
                    <label>
                        <strong>Відгук:</strong>
                    </label>

                    <textarea id="comment" type="text" class="form-control" name="recall"
                              size="90" required ng-model="graduate.recall"></textarea>
                    <div class="error" ng-show="errors.recall">{{errors.recall[0]}}</div>
                </div>

                <div class="form-group">
                    <label>
                        <strong>Ім'я англійською</strong>
                    </label>
                    <input id="nameEn" type="text" class="form-control" name="nameEn"
                           size="90" required ng-model="graduate.first_name_en">
                    <div class="error" ng-show="errors.first_name_en">{{errors.first_name_en[0]}}</div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label>
                            <strong>Прізвище англійською</strong>
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
                <button class="btn btn-primary" ng-click="updateGraduate()">Оновити</button>
            </div>
        </div>
    </div>
</div>
